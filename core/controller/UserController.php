<?php
namespace core\controller;

use core\rbmvc\AbstractController;

class UserController extends AbstractController {
    
   public function registrationAction() {
       if (!$this->request->isPost()) {
           return;
       }
       
       $parmas = $this->request->getParams();
       if ($parmas['password'] != $parmas['password2']) {

       }
   }
}