<?php
namespace RBMVC\Core\Controller;

use RBMVC\Core\Model\User;
use RBMVC\Core\View\View;
use RBMVC\Core\Request;
use RBMVC\Core\Controller\ActionHelperFactory;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\View\Helper\RenderSystemMessages;

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
     * @return void
     */
    public function init() {
        $this->view->assign('controller', $this->request->getParam('controller'));
        $this->view->assign('action', $this->request->getParam('action'));

    }
    
    /**
     * @return void
     */
    public function indexAction() {
        
    }
    
    /**
     * @param \RBMVC\Core\Request $request
     * @return void
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }
    
    /**
     * @return \RBMVC\Core\Request
     */
    public function getRequest() {
        return $this->request;
    }
    
    /**
     * @return \RBMVC\Core\View\View
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * @param \RBMVC\Core\View\View $view
     * @return void
     */
    public function setView(View &$view) {
        $this->view = $view;
    }
    
    /**
     * @return \RBMVC\Core\Controller\ActionHelperFactory
     */
    public function getActionHelperFactory() {
        return $this->actionHelperFactory;
    }

    /**
     * @param \RBMVC\Core\Controller\ActionHelperFactory $actionHelperFactory
     * @return \RBMVC\Core\Controller\AbstractController
     */
    public function setActionHelperFactory(ActionHelperFactory $actionHelperFactory) {
        $this->actionHelperFactory = $actionHelperFactory;
        return $this;
    }

        
    /**
     * @param integer $code
     * @return void
     */
    public function redirectToErrorPage($code) {
        header('Location: /error?c=' . base64_encode($code));
        exit;
    }
    
    /**
     * @param array $json
     * @return string
     */
    protected function sendJSON(array $json) {
        header('Content-type: application/json');
        echo json_encode($json);
    }
    
    /**
     * @param array $params
     * @return void
     */
    protected function redirect(array $params) {
        header('Location: ' . $this->view->url($params, true));
        exit;
    }
    
    /**
     * @param \RBMVC\Core\Utilities\SystemMessage $systemMessage
     * @return void
     */
    protected function addFlashSystemMessage(SystemMessage $systemMessage) {
        $session = new Session('system_message');
        $tmp = $session->systemMessages;
        $tmp[] = serialize($systemMessage);
        $session->systemMessages = $tmp ;
    }
    
    /**
     * @param \RBMVC\Core\Utilities\SystemMessage $systemMessage
     */
    protected function addSystemMessage(SystemMessage $systemMessage) {
        $renderSystemMessages = $this->view->getViewHelper('RenderSystemMessages');
        if ($renderSystemMessages instanceof RenderSystemMessages) {
            $renderSystemMessages->addSystemMessage($systemMessage);
        }
    }

    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args) {
        return $this->actionHelperFactory->callFunction($name, $args);
    }

}

