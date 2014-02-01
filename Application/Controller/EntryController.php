<?php
namespace Application\Controller;

use Application\Lib\Controller\AbstractRudiController;
use Application\Lib\Model\Entry;
use RBMVC\Core\Utilities\Session;

/**
 * Class EntryController
 * @package Application\Controller
 */
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
        $entry->setUser($session->user);

        $entry = $this->saveModel($entry, 'Application\Lib\Forms\EntryForm');
        $this->view->assign('entry', $entry);
    }

}