<?php
namespace RBMVC\Core;

use RBMVC\Core\Controller\AbstractController;
use RBMVC\Core\Controller\AbstractPlugin;
use RBMVC\Core\Controller\ActionHelperFactory;
use RBMVC\Core\Utilities\Exception\ClassLoadingException;
use RBMVC\Core\Utilities\Modifiers\String\DashToCamelCase;
use RBMVC\Core\View\View;

/**
 * Class Dispatcher
 * @package RBMVC\Core
 */
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
     * @var ClassLoader
     */
    private $classLoader;

    /**
     * @var array
     */
    private $config;

    /**
     * @return ClassLoader
     */
    public function getClassLoader() {
        return $this->classLoader;
    }

    /**
     * @param ClassLoader $classLoader
     *
     * @return Dispatcher
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
     * @return Dispatcher
     */
    public function setConfig(array $config) {
        $this->config = $config;

        return $this;
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
     * @return Dispatcher
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
     * @return Dispatcher
     */
    public function setView(View &$view) {
        $this->view = $view;

        return $this;
    }

    /**
     * @var void
     */
    public function setupController() {

        $controllerName  = ucfirst($this->request->getParam('controller')) . 'Controller';
        $dashToCamelCase = new DashToCamelCase();
        $controllerName  = $dashToCamelCase->convert($controllerName);

        $controller   = null;
        $isClassError = false;
        try {
            $controller = $this->classLoader->getClassInstance($controllerName);
        } catch (ClassLoadingException $e) {
            $controller   = $this->classLoader->getClassInstance('IndexController');
            $isClassError = true;
        }

        $actionHelperFactory = new ActionHelperFactory();
        $actionHelperFactory->setView($this->view);
        $actionHelperFactory->setRequest($this->request);
        $actionHelperFactory->setConfig($this->config);
        $actionHelperFactory->setClassLoader($this->classLoader);

        if ($controller instanceof AbstractController) {
            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->setActionHelperFactory($actionHelperFactory);
            $controller->setClassLoader($this->classLoader);
            $controller->setConfig($this->config);
            $controller->init();

            $actionStr = $dashToCamelCase->convert($this->request->getParam('action')) . 'Action';
            if (!method_exists($controller, $actionStr) || $isClassError) {
                $controller->redirectToErrorPage(404);
            } else {
                $this->loadPlugins();
                $controller->{$actionStr}();
            }
        } else {
            $controller->redirectToErrorPage(404);
        }
    }

    /**
     * @return void
     */
    private function loadPlugins() {
        $plugins = $this->classLoader->getAllClassesFromDir(array($this->config['settings']['controller_plugin_dir'],
                                                                  ROOT_DIR . 'RBMVC/Core/Controller/Plugins'
                                                            ));
        foreach ($plugins as $plugin) {
            if (!$plugin instanceof AbstractPlugin) {
                continue;
            }
            $plugin->onBootstrap($this->request);
        }
    }
}
