<?php
namespace RBMVC;

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
     * @return void
     */
    public function __construct() {
        $this->dispatcher = Dispatcher::getInstance();
    }
    
    /**
     * @param array $config
     * @return void
     */
    public function initApplication(array $config) {
        $this->config = $config;
        
        $this->setupLogging();
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
    private function setupDB() {
        if (!key_exists('database', $this->config)) {
            die('<h1>Error</h1><p>Missing database configuration.</p>');
        }
        
        $db = \RBMVC\DB\DB::getInstance();
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