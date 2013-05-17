<?php
namespace RBMVC\Controller;

class ErrorController extends  AbstractController {
    
    /**
     * @return void
     */
    public function indexAction() {
        $errorCode = $this->request->getParam('error_code', 500);
        $message = $this->getRequest()->getParam('message', 'Internal Server Error');
        
        $this->view->errorCode = $errorCode;
        $this->view->message = $message;
        header('HTTP/1.0 ' . $errorCode . '  ' . $message);
    }
}