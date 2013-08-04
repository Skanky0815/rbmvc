<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:08
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller\Helper;

use Application\Model\Collection\GrantCollection;
use Application\Model\Grant;
use RBMVC\Core\Controller\Helper\AbstractActionHelper;
use RBMVC\Core\Utilities\Modifiers\String\CamelCaseToDash;

class GrantScanner extends AbstractActionHelper {

    private $deleted = array();

    private $new = array();

    private $grants = array();

    private $allGrants = array();

    private $controllerNamespace;

    /**
     * @var \RBMVC\Core\Utilities\Modifiers\String\CamelCaseToDash
     */
    private $camelCaseToDash;

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

    /**
     * Search all actions from the controller class an return there names as array.
     *
     * @param \ReflectionClass $reflectionClass controller class
     *
     * @return array with action names
     */
    private function scanActions(\ReflectionClass $reflectionClass) {
        $actions = array();
        /** @var \ReflectionMethod $method */
        foreach ($reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            if (substr($method->name, -6) == 'Action') {
                $methodName = str_replace('Action', '', $method->name);
                $actions[]  = $this->camelCaseToDash->convert($methodName);
            }
        }

        return $actions;
    }

    private function createGrants($controller, array $actions) {
        foreach ($actions as $action) {
            $grant = new Grant();
            $grant->setDefinition($this->createDefinition($controller, $action));
            $grant->setType(Grant::TYPE_PROTECTED);
            $grant->setIsActive(true);
            $this->new[$grant->getDefinition()] = $grant;
        }
    }

    private function saveGrants() {
        /** @var \Application\Model\Grant $grant */
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

    private function createDefinition($controller, $action) {
        return $controller . '/' . $action;
    }

}