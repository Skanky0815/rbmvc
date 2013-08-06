<?php
namespace Application\Controller;

use Application\Model\Entry;
use RBMVC\Core\Utilities\Session;

class EntryController extends AbstractRudiController {

    public function __construct() {
        parent::__construct('Entry');
    }

    /**
     * @return void
     */
    public function editAction() {
        $entry   = new Entry();
        $session = new Session('user');
        $user    = $session->user;
        $entry->setUserId($user->getId());

        $entry = $this->saveModel($entry, 'Application\Forms\EntryForm');
        $this->view->assign('entry', $entry);
    }

}