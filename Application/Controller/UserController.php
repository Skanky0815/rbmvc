<?php
namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Model\Collection\UserCollection;

class UserController extends AbstractController {

    public function indexAction() {
        $entryCollection = new UserCollection();
        $entryCollection->findAll();

        $this->view->assign('users', $entryCollection->getModels());
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