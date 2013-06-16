<?php
namespace RBMVC\Controller;

use RBMVC\Core\Forms\EntryForm;
use RBMVC\Core\Utilities\SystemMessage;

class IndexController extends AbstractController {
    
    public function testAction() {
        $params = $this->request->getPostParams();
        
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
        
        $this->view->form = $form;
    }
    
}