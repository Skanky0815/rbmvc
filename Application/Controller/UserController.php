<?php
namespace Application\Controller;

use Application\Controller\AbstractController;

class UserController extends AbstractController {

    public function indexAction() {

    }

    public function editAction() {

    }
    
    /**
     * @return void
     */
   public function registrationAction() {
       if (!$this->request->isPost()) {
           return;
       }
       
       $params = $this->request->getParams();
       if ($params['password'] != $params['password2']) {

       }
   }
}