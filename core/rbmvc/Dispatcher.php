<?php
namespace core\rbmvc;

use core\rbmvc\View;
use core\rbmvc\Request;
use core\rbmvc\view\helper\Url;
use core\rbmvc\AbstractController;

class Dispatcher {
    
    private $request;
    
    private $view;
    
    private static $instance = null;
    
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Dispatcher;
        }
        
        return self::$instance;
    }
    
    public function init() {
        $this->request = new Request();
        
        $this->doRouting();
        $this->setupView();
        $this->setupController();
        
        echo $this->view->render();
    }
    
    private function doRouting() {
        $url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '';
        $request = explode('/', $url);
        $params = 
                array('controller' => !empty($request[1]) ? $request[1] : 'index'
                    , 'action' => !empty($request[2]) ? $request[2] : 'index'
            
        );
        $this->request->addGetParams($params);
    }
    
    private function setupController() {
        $controllerName = ucfirst($this->request->getParam('controller'));
        $controllerStr = sprintf('\core\controller\%sController', $controllerName);
        $controller = new $controllerStr();
        if ($controller instanceof AbstractController) {
            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->init();
            $actionStr = $this->request->getParam('action') . 'Action';
            $controller->$actionStr();
        }
    }
    
    private function setupView() {
        $this->view = new View();
        
        $url = new Url($this->request, $this->view);
        $this->view->addHelper($url);
        
        $dateFormater = new view\helper\DateFormater($this->request, $this->view); 
        $this->view->addHelper($dateFormater);
        
        $this->view->setParams($this->request->getParams());  
    }
}
