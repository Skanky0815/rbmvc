<?php 
namespace RBMVC\Controller;

use RBMVC\Core\Model\Entry;
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