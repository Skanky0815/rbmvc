<?php
namespace RBMVC\Core\Utilities;

use RBMVC\Core\View\View;
use RBMVC\Core\ClassLoader;
use RBMVC\Core\Request;

abstract class AbstractHelperFactory {
    
    /**
     * @var \RBMVC\Core\View\View
     */
    protected $view;

    /**
     * @var \RBMVC\Core\Request
     */
    protected $request;
    
    /**
     * @var array
     */
    protected $helper = array();

    /**
     * @var \RBMVC\Core\ClassLoader
     */
    protected $classLoader;
    
    /**
     * @param \RBMVC\Core\View\View $view
     * @return \RBMVC\Core\Utilities\AbstractHelperFactory
     */
    public function setView(View &$view) {
        $this->view = $view;
        return $this;
    }
    
    /**
     * @return \RBMVC\Core\View\View 
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * @param \RBMVC\Core\Request $request
     * @return \RBMVC\Core\Utilities\AbstractHelperFactory
     */
    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }
    
    /**
     * @return \RBMVC\Core\Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @param \RBMVC\Core\ClassLoader $classLoader
     * @return \RBMVC\Core\Utilities\AbstractHelperFactory
     */
    public function setClassLoader(ClassLoader $classLoader) {
        $this->classLoader = $classLoader;
        return $this;
    }

    /**
     * @return \RBMVC\Core\ClassLoader
     */
    public function getClassLoader() {
        return $this->classLoader;
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function callFunction($name, $args) {
        $name = strtolower($name);
        $helper = $this->getHelper($name);
        return call_user_func_array(array($helper, $name), $args);
    }
    
    /**
     * @param string $name
     * @return \RBMVC\Core\Utilities\AbstractHelper
     */
    protected abstract function loadHelper($name);
        
    /**
     * @param string $name
     * @return \RBMVC\Core\Utilities\AbstractHelper
     */
    public function getHelper($name) {
        if (array_key_exists($name, $this->helper)) {
            return $this->helper[$name];
        }
        
        return $this->loadHelper($name);
    }
    
}