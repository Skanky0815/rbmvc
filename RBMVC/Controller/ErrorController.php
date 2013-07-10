<?php
namespace RBMVC\Controller;

use RBMVC\Core\Controller\AbstractController;

class ErrorController extends AbstractController {
    
    /**
     * @return void
     */
    public function indexAction() {
        $statusCode = $this->request->getParam('c');
        if (empty($statusCode)) {
            $statusCode = 500;
        } else {
            $statusCode = (integer) base64_decode($statusCode);
        }
        
        $this->view->statusCode = $statusCode;
        $this->view->title = $statusCode.'_title';
        $this->view->message = $statusCode . '_message';
        http_response_code($statusCode);
    }
}