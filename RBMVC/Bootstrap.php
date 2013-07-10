<?php
namespace RBMVC;

use RBMVC\Core\DB\DB;
use RBMVC\Core\View\View;
use RBMVC\Core\View\ViewHelperFactory;
use RBMVC\Core\Request;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Translator;
use RBMVC\Core\Dispatcher;

class Bootstrap {
    
    /**
     * @var Request 
     */
    private $request;
    
    /*
     * @var array
     */
    private $config;
    
    /**
     * @param array $config
     * @return string
     */
    public function run(array $config) {
        Session::start();
        
        $this->config = $config;
        
        $this->setupLogging();
        $this->setupTranslation();
        $this->setupDB();
        $this->request = new Request();
        $dispatcher = new Dispatcher();
        $dispatcher->setRequest($this->request);
        $view = $this->setupView();
        $dispatcher->setView($view);
        $dispatcher->setupController();
        
        return $dispatcher->getView()->render();
    }
    
    /**
     * @return void
     */
    private function setupLogging() {
        ini_set('error_log', APPLICATION_DIR . 'data/log/php_error.log');
    }
    
    /**
     * @return void
     */
    private function setupTranslation() {
        if (!key_exists('language', $this->config)) {
            die('<h1>Error</h1><p>Missing language configuration.</p>');
        }
        Translator::getInstance()->init($this->config['language']);
    }
    
    /**
     * @return void
     */
    private function setupDB() {
        if (!key_exists('database', $this->config)) {
            die('<h1>Error</h1><p>Missing database configuration.</p>');
        }
        
        $db = DB::getInstance();
        $db->setup($this->config['database']);
    }
   
    /**
     * @return \RBMVC\Core\View\View
     */
    private function setupView() {
//        if (!key_exists('view', $this->config)) {
//            die('<h1>Error</h1><p>Missing view configuration.</p>');
//        }
        
        $view = new View();
        $view->setParams($this->request->getParams());
        
        $viewHelperFactory = new ViewHelperFactory();
        $viewHelperFactory->setView($view);
        $viewHelperFactory->setRequest($this->request);
        $view->setViewHelperFactory($viewHelperFactory);
        
        return $view;
    }
}