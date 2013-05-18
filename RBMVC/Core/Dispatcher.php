<?php
namespace RBMVC\Core;

use RBMVC\View\View;
use RBMVC\View\Helper\AbstractHelper;
use RBMVC\Controller\IndexController;
use RBMVC\Controller\AbstractController;

class Dispatcher {
    
    /**
     * @var Request 
     */
    private $request;
    
    /**
     * @var View 
     */
    private $view;
    
    /**
     * @var Dispatcher
     */
    private static $instance = null;
    
    /**
     * @return Dispatcher
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Dispatcher;
        }
        
        return self::$instance;
    }
    
    /**
     * @return void
     */
    private function __construct() {
        $this->request = new Request();
        $this->view = new View();
        $this->view->setParams($this->request->getParams());
    }
    
    /**
     * @var void
     */
    public function setupController() {
        $controllerName = ucfirst($this->request->getParam('controller'));
        $controllerStr = sprintf('\RBMVC\Controller\%sController', $controllerName);
        
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
        
        if ($controller instanceof AbstractController) {
            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->init();
            $actionStr = $this->request->getParam('action') . 'Action';
            if (!method_exists($controller, $actionStr) || $isClassError) {
                $controller->redirectToErrorPage(404);
            } else {
                $controller->$actionStr();
            }
        } else {
            $controller->redirectToErrorPage(404);
        }
    }
    
    /**
     * @param array $options
     * @return void
     */
    public function setupView(array $options) {
        if (!key_exists('helper', $options) || !is_array($options['helper'])) {
            return;
        }
        
        /* @var $helper AbstractHelper */
        foreach ($options['helper'] as $helper) {
            if (!$helper instanceof AbstractHelper) {
                continue;
            }
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $this->view->addHelper($helper);
        }
    }
    
    /**
     * @return View
     */
    public function getView() {
        return $this->view;
    }
}
