<?php
namespace RBMVC\Core\View;

use RBMVC\Core\View\Helper\AbstractHelper;
use RBMVC\Core\Request;

class ViewHelperFactory {
    
    /**
     * @var View
     */
    private $view;

    /**
     * @var Request
     */
    private $request;
    
    /**
     * @var array
     */
    private $helper = array();
    
    /**
     * @param View $view
     * @return void
     */
    public function setView(View $view) {
        $this->view = $view;
    }
    
    /**
     * @return View
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * @param Request $request
     * @return void
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }
    
    /**
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }
    
    /**
     * @param string $name
     * @return AbstractHelper
     */
    public function getHelper($name) {
        if (key_exists($name, $this->helper)) {
            return $this->helper[$name];
        }
        
        return $this->loadHelper($name);
    }
    
    /**
     * @param string $name
     * @return AbstractHelper
     */
    private function loadHelper($name) {
        $className = '\RBMVC\Core\View\Helper\\' . ucfirst($name);
        $helper = new $className;
        if ($helper instanceof AbstractHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $this->helper[$name] = $helper;
            return $helper;
        }
    }

}