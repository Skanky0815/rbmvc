<?php 
namespace core\controller;

use core\rbmvc\AbstractController;
use core\rbmvc\model\Entry;
use core\rbmvc\model\collection\EntryCollection;

class EntryController extends AbstractController {
    
    public function indexAction() {
        $entryCollection = new EntryCollection();
        $entryCollection->findAll();
        
        $this->view->entries = $entryCollection->getModels();
    }
    
    public function editAction() {
        $entryId = (int) $this->request->getParam('id', 0);
        $entry = new Entry();
        
        if (!empty($entryId)) {
            $entry->setId($entryId)->init();
        }
        
        if ($this->request->isPost()) {
            $entry->fillModelByArray($this->request->getPostParams());
            $entry->save();
        }
        $this->view->entry = $entry;
    }
    
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