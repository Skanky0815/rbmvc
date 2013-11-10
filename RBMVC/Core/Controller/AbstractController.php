<?php
namespace RBMVC\Core\Controller;

use RBMVC\Core\ClassLoader;
use RBMVC\Core\Request;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\View\Helper\RenderSystemMessages;
use RBMVC\Core\View\Helper\Url;
use RBMVC\Core\View\View;

/**
 * Class AbstractController
 * @package RBMVC\Core\Controller
 */
abstract class AbstractController {

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var View
     */
    protected $view;

    /**
     *
     * @var ActionHelperFactory
     */
    protected $actionHelperFactory;

    /**
     * @var ClassLoader
     */
    protected $classLoader;

    /**
     * @var array
     */
    protected $config = array();

    /**
     * @return void
     */
    public function indexAction() {

    }

    /**
     * @return void
     */
    public function init() {
        $this->view->assign('controller', $this->request->getParam('controller'));
        $this->view->assign('action', $this->request->getParam('action'));
    }

    /**
     * @param string $name
     * @param array $args
     *
     * @return mixed
     */
    public function __call($name, $args) {
        return $this->actionHelperFactory->callFunction($name, $args);
    }

    /**
     * @return ActionHelperFactory
     */
    public function getActionHelperFactory() {
        return $this->actionHelperFactory;
    }

    /**
     * @param ActionHelperFactory $actionHelperFactory
     *
     * @return AbstractController
     */
    public function setActionHelperFactory(ActionHelperFactory $actionHelperFactory) {
        $this->actionHelperFactory = $actionHelperFactory;

        return $this;
    }

    /**
     * @return ClassLoader
     */
    public function getClassLoader() {
        return $this->classLoader;
    }

    /**
     * @param ClassLoader $classLoader
     *
     * @return AbstractController
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
     * @return AbstractController
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
     * @return void
     */
    public function setRequest(Request $request) {
        $this->request = $request;
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
     * @return void
     */
    public function setView(View &$view) {
        $this->view = $view;
    }

    /**
     * @param integer $code
     *
     * @return void
     */
    public function redirectToErrorPage($code) {
        header('Location: /error?c=' . base64_encode($code));
        exit;
    }

    /**
     * @param SystemMessage $systemMessage
     *
     * @return void
     */
    protected function addFlashSystemMessage(SystemMessage $systemMessage) {
        $session                 = new Session('system_message');
        $tmp                     = $session->systemMessages;
        $tmp[]                   = $systemMessage;
        $session->systemMessages = $tmp;
    }

    /**
     * @param SystemMessage $systemMessage
     */
    protected function addSystemMessage(SystemMessage $systemMessage) {
        $renderSystemMessages = $this->view->getViewHelper('RenderSystemMessages');
        if ($renderSystemMessages instanceof RenderSystemMessages) {
            $renderSystemMessages->addSystemMessage($systemMessage);
        }
    }

    /**
     * @param array $params
     *
     * @return void
     */
    protected function redirect(array $params) {
        /** @var Url $urlHelper */
        $urlHelper = $this->view->getViewHelper('Url');
        header('Location: ' . $urlHelper->url($params, true));
        exit;
    }

    /**
     * @param array $json
     *
     * @return string
     */
    protected function sendJSON(array $json) {
        header('Content-type: application/json');
        echo json_encode($json);
    }

}

