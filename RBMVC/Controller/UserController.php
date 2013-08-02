<?php
namespace RBMVC\Controller;

use RBMVC\Core\Controller\AbstractController;

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
       
       $parmas = $this->request->getParams();
       if ($parmas['password'] != $parmas['password2']) {

       }
   }
}