<?php
namespace RBMVC\Controller;

use RBMVC\Core\View\View;
use RBMVC\Core\Request;
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
     * @return void
     */
    public function init() {
        $this->view->controller = $this->request->getParam('controller');
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
     * @return Request
     */
    public function getRequest() {
        return $this->request;
    }
    
    /**
     * @return View
     */
    public function getView() {
        return $this->view;
    }
    
    /**
     * @param \RBMVC\View\View $view
     * @return void
     */
    public function setView(View &$view) {
        $this->view = $view;
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
     * @return void
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
}

