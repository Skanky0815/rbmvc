<?php
namespace Application\Controller;

use Application\Controller\AbstractController;
use Application\Model\Collection\EntryCollection;
use RBMVC\Core\Utilities\SystemMessage;

class IndexController extends AbstractController {

    public function indexAction() {
        $entryCollection = new EntryCollection();
        $entryCollection->findAll();
        $entries = $entryCollection->getModels();
        array_splice($entries, 2);
        $this->view->assign('entries', $entries);
    }

}