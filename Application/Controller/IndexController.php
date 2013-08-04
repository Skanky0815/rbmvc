<?php
namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Model\Collection\EntryCollection;
use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\Utilities\Session;

class IndexController extends AbstractController {

    public function indexAction() {
        $entryCollection = new EntryCollection();
        $entryCollection->findAll();
        $entries = $entryCollection->getModels();
        array_splice($entries, 2);
        $this->view->assign('entries', $entries);
    }
    
    public function testAction() {
        $params = $this->request->getPostParams();
        
        $session = new Session(('user'));
        error_log(__METHOD__.'user ::> '.print_r($session->user, 1));

        $form = new EntryForm($params);
        if ($this->request->isPost()) {
            $systemMessage = new SystemMessage(SystemMessage::ERROR);
            $systemMessage->setText('invalid_form');
            if ($form->isValid($params)) {
                $systemMessage->setType(SystemMessage::SUCCESS);
                $systemMessage->setTitle('save_success');
                $systemMessage->setText('');
            }
            $this->addSystemMessage($systemMessage);
        }
        
        $this->view->assign('form', $form);
    }
    
}