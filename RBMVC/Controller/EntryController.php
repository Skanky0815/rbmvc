<?php 
namespace RBMVC\Controller;

use RBMVC\Core\Model\Entry;
use RBMVC\Core\Controller\AbstractController;
use RBMVC\Core\Model\Collection\EntryCollection;
use RBMVC\Core\Utilities\Session;

class EntryController extends AbstractController {
    
    /**
     * @return void
     */
    public function indexAction() {
        $entryCollection = new EntryCollection();
        $entryCollection->findAll();
        
        $this->view->assign('entries', $entryCollection->getModels());
    }
    
    /**
     * @return void
     */
    public function editAction() {
        $entry = new Entry();
        $session = new Session('user');
        $user = $session->user;
        $entry->setUserId($user['id']);

        $entry = $this->saveModel($entry, 'RBMVC\Core\Forms\EntryForm');
        $this->view->assign('entry', $entry);
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