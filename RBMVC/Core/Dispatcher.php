<?php
namespace RBMVC\Core;

use RBMVC\Core\View\View;
use RBMVC\Controller\IndexController;
use RBMVC\Core\Controller\AbstractController;
use RBMVC\Core\Controller\ActionHelperFactory;

class Dispatcher {
    
    /**
     * @var \RBMVC\Core\Request
     */
    private $request;
    
    /**
     * @var \RBMVC\Core\View\View
     */
    private $view;
    
    /**
     * @var void
     */
    public function setupController() {
        $controllerName = ucfirst($this->request->getParam('controller'));
        $controllerStr = sprintf('\Application\Controller\%sController', $controllerName);
        
        $controller = null;
        $isClassError = false;
        try {
            if (class_exists($controllerStr)) {
                $controller = new $controllerStr();
            }
        } catch(\LogicException $e) {
            error_log(__METHOD__.'::> '.print_r($e->getMessage(), 1));
            $controller = new IndexController();
            $isClassError = true;
            
        }
        
        $actionHelperFactory = new ActionHelperFactory();
        $actionHelperFactory->setView($this->view);
        $actionHelperFactory->setRequest($this->request);
        
        if ($controller instanceof AbstractController) {
            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->setActionHelperFactory($actionHelperFactory);
            $controller->init();
            $actionStr = $this->request->getParam('action') . 'Action';
            if (!method_exists($controller, $actionStr) || $isClassError) {
                $controller->redirectToErrorPage(404);
            } else {
                $controller->{$actionStr}();
            }
        } else {
            $controller->redirectToErrorPage(404);
        }
    }
    
    /**
     * @return \RBMVC\Core\View\View
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * @param \RBMVC\Core\View\View $view
     * @return \RBMVC\Core\Dispatcher
     */
    public function setView(View &$view) {
        $this->view = $view;
        return $this;
    }
    
    /**
     * @return \RBMVC\Core\Request
     */
    public function getRequest() {
        return $this->request;
    }
    
    /**
     * @param \RBMVC\Core\Request $request
     * @return \RBMVC\Core\Dispatcher
     */
    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }

}
