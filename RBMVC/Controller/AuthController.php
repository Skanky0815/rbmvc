<?php
namespace RBMVC\Controller;

use RBMVC\Core\Controller\AbstractController;
use RBMVC\Core\Model\User;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\Forms\LoginForm;

class AuthController extends AbstractController {
    
    public function indexAction() {
        $this->redirect(array('action' => 'login'));
    }
    
    public function loginAction() {
        $user = new User();
        $user->fillModelByArray($this->request->getPostParams());
        
        $form = new LoginForm($user);
        if ($this->request->isPost()) {
            
            if ($form->isValid($this->request->getPostParams())) {
                if ($user->exists()) {
                    $session = new Session('user');
                    $session->user = $user->toArray();
                    
                    $systemMessage = new SystemMessage(SystemMessage::SUCCESS);
                    $this->addFlashSystemMessage($systemMessage);
                    $this->redirect(array('controller' => 'index', 'action' => 'index'));
                } else {
                    $systemMessage = new SystemMessage(SystemMessage::INFO);
                    $systemMessage->setText('no_user_found');
                    $this->addSystemMessage($systemMessage);
                }
            } else {
                $systemMessage = new SystemMessage(SystemMessage::ERROR);
                $this->addSystemMessage($systemMessage);
            }
        }
        
        $this->view->assign('form', $form);
    }
    
    public function logoutAction() {
        $session = new Session('user');
        $session->resetNamespace();
        
        $this->redirect(array('controller' => 'index', 'action' => 'index'));
    }
    
}