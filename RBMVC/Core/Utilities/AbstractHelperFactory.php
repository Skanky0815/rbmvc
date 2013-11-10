<?php
namespace RBMVC\Core\Utilities;

use RBMVC\Core\ClassLoader;
use RBMVC\Core\Request;
use RBMVC\Core\View\View;

/**
 * Class AbstractHelperFactory
 * @package RBMVC\Core\Utilities
 */
abstract class AbstractHelperFactory {

    /**
     * @var View
     */
    protected $view;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var AbstractHelper[]
     */
    protected $helpers = array();

    /**
     * @var ClassLoader
     */
    protected $classLoader;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param string $name
     * @param array $args
     *
     * @return mixed
     */
    public function callFunction($name, $args) {
        $name   = strtolower($name);
        $helper = $this->getHelpers($name);

        return call_user_func_array(array($helper, $name), $args);
    }

    /**
     * @return ClassLoader
     */
    public function getClassLoader() {
        return $this->classLoader;
    }

    /**
     * @param ClassLoader $classLoader
     *
     * @return AbstractHelperFactory
     */
    public function setClassLoader(ClassLoader $classLoader) {
        $this->classLoader = $classLoader;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * @param array $config
     *
     * @return AbstractHelperFactory
     */
    public function setConfig(array $config) {
        $this->config = $config;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return AbstractHelper
     */
    public function getHelpers($name) {
        if (array_key_exists($name, $this->helpers)) {
            return $this->helpers[$name];
        }

        return $this->loadHelper($name);
    }

    /**
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @param Request $request
     *
     * @return AbstractHelperFactory
     */
    public function setRequest(Request $request) {
        $this->request = $request;

        return $this;
    }

    /**
     * @return View
     */
    public function getView() {
        return $this->view;
    }

    /**
     * @param View $view
     *
     * @return AbstractHelperFactory
     */
    public function setView(View &$view) {
        $this->view = $view;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return AbstractHelper
     */
    protected abstract function loadHelper($name);

}