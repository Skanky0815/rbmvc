<?php
namespace Application\Controller;

use Application\Lib\Controller\AbstractController;
use Application\Lib\Model\Collection\EntryCollection;

/**
 * Class IndexController
 * @package Application\Controller
 */
class IndexController extends AbstractController {

    /**
     * @return void
     */
    public function indexAction() {
        $entryCollection = new EntryCollection();
        $entryCollection->findAll();
        $entries = $entryCollection->getModels();
        array_splice($entries, 2);
        $this->view->assign('entries', $entries);
    }

}