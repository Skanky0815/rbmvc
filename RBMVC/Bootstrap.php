<?php
namespace RBMVC;

use RBMVC\Core\DB\DB;
use RBMVC\Core\Translator;
use RBMVC\Core\Dispatcher;

class Bootstrap {
    
    /**
     * @var Bootstrap 
     */
    private static $instance = null;
    
    /**
     * @var Dispatcher
     */
    private $dispatcher;
    
    /*
     * @var array
     */
    private $config;
    
    /**
     * @return Bootstrap
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Bootstrap();
        }
        return self::$instance;
    }
    
    /**
     * @param array $config
     * @return void
     */
    public function initApplication(array $config) {
        $this->config = $config;
        
        $this->setupLogging();
        $this->dispatcher = Dispatcher::getInstance();
        $this->setupTranslation();
        $this->setupDB();
        $this->setupView();
        $this->dispatcher->setupController();
        
        echo $this->dispatcher->getView()->render();
    }
    
    /**
     * @return void
     */
    private function setupLogging() {
        ini_set('error_log', APPLICATION_DIR . '/data/log/php_error.log');
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
     * @return void
     */
    private function setupView() {
        if (!key_exists('view', $this->config)) {
            die('<h1>Error</h1><p>Missing view configuration.</p>');
        }
        
        $this->dispatcher->setupView($this->config['view']);
    }
}