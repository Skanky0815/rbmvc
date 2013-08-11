<?php
namespace RBMVC\Core;

use RBMVC\Core\ClassLoader;
use RBMVC\Core\Controller\AbstractController;
use RBMVC\Core\Controller\AbstractPlugin;
use RBMVC\Core\Controller\ActionHelperFactory;
use RBMVC\Core\Utilities\Modifiers\String\DashToCamelCase;
use RBMVC\Core\View\View;

/**
 * Class Dispatcher
 * @package RBMVC\Core
 */
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
     * @var \RBMVC\Core\ClassLoader
     */
    private $classLoader;

    /**
     * @var array
     */
    private $config;

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
        } catch (Utilities\Exception\ClassLoadingException $e) {
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
            $controller->init();
            $actionStr = $this->request->getParam('action') . 'Action';
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

    private function loadPlugins() {
        $plugins = $this->classLoader->getAllClassesFromDir(array(APPLICATION_DIR . 'Lib/Controller/Plugins',
                                                                  ROOT_DIR . 'RBMVC/Core/Controller/Plugins'
                                                            ));
        foreach ($plugins as $plugin) {
            if (!$plugin instanceof AbstractPlugin) {
                continue;
            }
            $plugin->onBootstrap($this->request);
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
     *
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
     *
     * @return \RBMVC\Core\Dispatcher
     */
    public function setRequest(Request $request) {
        $this->request = $request;

        return $this;
    }

    /**
     * @return \RBMVC\Core\ClassLoader
     */
    public function getClassLoader() {
        return $this->classLoader;
    }

    /**
     * @param \RBMVC\Core\ClassLoader $classLoader
     *
     * @return \RBMVC\Core\Dispatcher
     */
    public function setClassLoader(ClassLoader $classLoader) {
        $this->classLoader = $classLoader;

        return $this;
    }

    /**
     * @param array $config
     *
     * @return \RBMVC\Core\Dispatcher
     */
    public function setConfig(array $config) {
        $this->config = $config;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig() {
        return $this->config;
    }
}
