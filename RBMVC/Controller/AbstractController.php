<?php
namespace RBMVC\Controller;

use RBMVC\View\View;
use RBMVC\Request;

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
     * @param \RBMVC\Request $request
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
     * @param string $errorCode
     * @param string $message
     * @return void
     */
    public function redirectToErrorPage($errorCode, $message) {
        $params = array(
            'controller' => 'error',
            'action' => 'index',
            'error_code' => $errorCode,
            'message' => $message,
        );
        $this->redirect($params);
    }
    
    /**
     * @param array $json
     * @return string
     */
    protected function sendJSON(array $json) {
        header('Content-type: application/json');
        return json_encode($json);
    }
    
    /**
     * @param array $params
     * @return void
     */
    protected function redirect(array $params) {
        header('Location: ' . $this->view->url($params));
        exit;
    }
    
}

