<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:08
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Controller\Helper;

use Application\Lib\Model\Collection\GrantCollection;
use Application\Lib\Model\Grant;
use RBMVC\Core\Controller\Helper\AbstractActionHelper;
use RBMVC\Core\Utilities\Modifiers\String\CamelCaseToDash;

/**
 * Class GrantScanner
 * @package Application\Lib\Controller\Helper
 */
class GrantScanner extends AbstractActionHelper {

    /**
     * @var array
     */
    private $deleted = array();

    /**
     * @var Grant[]
     */
    private $new = array();

    /**
     * @var Grant[]
     */
    private $grants = array();

    /**
     * @var Grant[]
     */
    private $allGrants = array();

    /**
     * @var string
     */
    private $controllerNamespace;

    /**
     * @var CamelCaseToDash
     */
    private $camelCaseToDash;

    /**
     * @return bool
     */
    public function init() {
        if (!isset($this->config['class_paths'])
            || (isset($this->config['class_paths']) && !isset($this->config['class_paths']['controller']))
        ) {
            return false;
        }

        $this->controllerNamespace = $this->config['class_paths']['controller'];
        $this->camelCaseToDash     = new CamelCaseToDash();

        $allGrants = new GrantCollection();
        $allGrants->findAll();
        $this->allGrants = $allGrants->getModels();

        return true;
    }

    /**
     * @return array
     */
    public function grantScanner() {
        if (!$this->init()) {
            return $this->grants;
        }

        $controllers = $this->scanControllers();
        foreach ($controllers as $controller => $actions) {
            $this->createGrants($controller, $actions);
        }

        $this->saveGrants();

        $this->grants['new']     = $this->new;
        $this->grants['deleted'] = $this->deleted;

        return $this->grants;
    }

    /**
     * @param $controller
     * @param $action
     *
     * @return string
     */
    private function createDefinition($controller, $action) {
        return '/' . $controller . '/' . $action;
    }

    /**
     * @param string $controller
     * @param array $actions
     *
     * @return void
     */
    private function createGrants($controller, array $actions) {
        foreach ($actions as $action) {
            $grant = new Grant();
            $grant->setDefinition($this->createDefinition($controller, $action));
            $grant->setType(Grant::TYPE_PROTECTED);
            $grant->setIsActive(true);
            $this->new[$grant->getDefinition()] = $grant;
        }
    }

    /**
     * @return void
     */
    private function saveGrants() {
        foreach ($this->allGrants as $grant) {
            if (isset($this->new[$grant->getDefinition()])) {
                unset($this->new[$grant->getDefinition()]);
            } else {
                $this->deleted[] = $grant;
                $grant->delete();
            }
        }

        $new = array();
        foreach ($this->new as $grant) {
            if (!$grant->save()) {
                // @TODO add error message for not saved grants
                continue;
            };
            $new[] = $grant;
        }
        $this->new = $new;
    }

    /**
     * Search all actions from the controller class an return there names as array.
     *
     * @param \ReflectionClass $reflectionClass controller class
     *
     * @return array with action names
     */
    private function scanActions(\ReflectionClass $reflectionClass) {
        $actions = array();
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (substr($method->name, -6) == 'Action') {
                $methodName = str_replace('Action', '', $method->name);
                $actions[]  = $this->camelCaseToDash->convert($methodName);
            }
        }

        return $actions;
    }

    /**
     * @return array
     */
    private function scanControllers() {
        $controllers = array();

        $dirPath = ROOT_DIR . str_replace('\\', '/', $this->controllerNamespace);
        if (!file_exists($dirPath)) {
            return $controllers;
        }

        $dirIterator = new \DirectoryIterator($dirPath);
        /** @var \DirectoryIterator $item */
        foreach ($dirIterator as $item) {
            if (!$item->isFile() || !strstr($item->getFilename(), 'Controller.php')) {
                continue;
            }

            $className       = $this->controllerNamespace . str_replace('.php', '', $item->getFilename());
            $reflectionClass = new \ReflectionClass($className);
            if ($reflectionClass->isAbstract()) {
                continue;
            }

            $camelCaseToDash          = new CamelCaseToDash();
            $controller               =
                $camelCaseToDash->convert(str_replace('Controller.php', '', $item->getFilename()));
            $controllers[$controller] = $this->scanActions($reflectionClass);
        }

        return $controllers;
    }

}