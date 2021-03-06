<?php
namespace Application\Controller;

use Application\Lib\Controller\AbstractController;
use Application\Lib\Forms\LoginForm;
use Application\Lib\Model\LoggedInUser;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;

/**
 * Class AuthController
 * @package Application\Controller
 */
class AuthController extends AbstractController {

    /**
     * @return void
     */
    public function indexAction() {
        $this->redirect(array('action' => 'login'));
    }

    /**
     * @return void
     */
    public function loginAction() {
        $user = new LoggedInUser();
        $user->fillModelByArray($this->request->getPostParams());

        $form = new LoginForm($this->view, $user);
        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPostParams())) {
                if ($user->exists() && $user->isActive()) {
                    $session       = new Session('user');
                    $session->user = $user;

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

    /**
     * @return void
     */
    public function logoutAction() {
        $session = new Session('user');
        $session->resetNamespace();

        $this->redirect(array('controller' => 'index', 'action' => 'index'));
    }

}