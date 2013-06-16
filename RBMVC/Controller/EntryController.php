<?php 
namespace RBMVC\Controller;

use RBMVC\Core\Model\Entry;
use RBMVC\Core\Forms\EntryForm;
use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\Model\Collection\EntryCollection;

class EntryController extends AbstractController {
    
    /**
     * @return void
     */
    public function indexAction() {
        $entryCollection = new EntryCollection();
        $entryCollection->findAll();
        
        $this->view->entries = $entryCollection->getModels();
    }
    
    /**
     * @return void
     */
    public function editAction() {
        $entryId = (int) $this->request->getParam('id', 0);
        $params = $this->request->getPostParams();
        
        $entry = new Entry();
        
        if (!empty($entryId)) {
            $entry->setId($entryId)->init();
        } 
        $entry->fillModelByArray($params);
        
        $form = new EntryForm($entry);
        if ($this->request->isPost()) {
            if ($form->isValid($params)) {
                $entry = $entry->save();
                if ($entry instanceof Entry) {
                    $systemMessage = new SystemMessage(SystemMessage::SUCCESS);
                    $systemMessage->setTitle('save_success');
                    $this->addSystemMessage($systemMessage);
                    $this->redirect(array('id' => $entry->getId()));
                }
            } else {
                $systemMessage = new SystemMessage(SystemMessage::ERROR);
                $systemMessage->setText('invalid_form'); 
                $this->addSystemMessage($systemMessage);
            }
        }
        
        $this->view->entry = $entry;
        $this->view->form = $form;
    }
    
    /**
     * @return string
     */
    public function deleteAction() {
        $this->view->disableRender();
        $entryId = $this->request->getParam('id', 0);
        
        if (empty($entryId)) {
            return $this->sendJSON(
                    array('status' => 'error' 
                        , 'text' => 'keine gültige id'
                    )
            );
        }
        
        $entry = new Entry();
        $entry->setId($entryId)->delete();

        return $this->sendJSON(
                array('status' => 'ok'
                    , 'data' => array('id' => $entryId)
                )
        );
    }
}