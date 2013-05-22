<?php
namespace RBMVC\Controller;

class UserController extends AbstractController {
    
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