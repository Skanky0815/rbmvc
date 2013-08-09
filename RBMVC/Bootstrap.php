<?php
namespace RBMVC;

use RBMVC\Core\ClassLoader;
use RBMVC\Core\DB\DB;
use RBMVC\Core\Dispatcher;
use RBMVC\Core\Request;
use RBMVC\Core\Translator;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\View\View;
use RBMVC\Core\View\ViewHelperFactory;

class Bootstrap {

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $config;

    /**
     * @var ClassLoader
     */
    private $classLoader;

    public function __construct(ClassLoader $classLoader) {
        $this->classLoader = $classLoader;
    }

    /**
     * @param array $config
     *
     * @return string
     */
    public function run(array $config) {
        Session::start();

        $this->config = $config;

        $this->setupLogging();
        $this->setupClassLoader();
        $this->setupTranslation();
        $this->setupDB();
        $this->request = new Request();
        $dispatcher    = new Dispatcher();
        $dispatcher->setRequest($this->request);
        $dispatcher->setConfig($this->config);
        $dispatcher->setClassLoader($this->classLoader);
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

    private function setupClassLoader() {
        if (isset($this->config['class_paths']) && is_array($this->config['class_paths'])) {
            $this->classLoader->addNamespaces($this->config['class_paths']);
        }

        $defaults = array(
            __NAMESPACE__ . '\\Core\\View\\Helper\\',
            __NAMESPACE__ . '\\Core\\Controller\\Helper\\',
            __NAMESPACE__ . '\\Core\\Controller\\Plugins\\',
        );

        $this->classLoader->addNamespaces($defaults);
    }

    /**
     * @return void
     */
    private function setupTranslation() {
        if (!array_key_exists('language', $this->config)) {
            die('<h1>Error</h1><p>Missing language configuration.</p>');
        }
        Translator::getInstance()->init($this->config['language']);
    }

    /**
     * @return void
     */
    private function setupDB() {
        if (!array_key_exists('database', $this->config)) {
            die('<h1>Error</h1><p>Missing database configuration.</p>');
        }

        $db = DB::getInstance();
        $db->setup($this->config['database']);
    }

    /**
     * @return \RBMVC\Core\View\View
     */
    private function setupView() {
        $view = new View();
        $view->setParams($this->request->getParams());

        $viewHelperFactory = new ViewHelperFactory();
        $viewHelperFactory->setClassLoader($this->classLoader);
        $viewHelperFactory->setView($view);
        $viewHelperFactory->setRequest($this->request);
        $viewHelperFactory->setConfig($this->config);
        $view->setViewHelperFactory($viewHelperFactory);

        return $view;
    }
}