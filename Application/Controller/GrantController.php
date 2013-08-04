<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:07
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller;

use Application\Model\Grant;
use Application\Model\Collection\GrantCollection;

class GrantController extends AbstractController {

    public function indexAction() {
        $grantCollection = new GrantCollection();
        $grantCollection->findAll();

        $this->view->assign('grants', $grantCollection->getModels());
    }

    public function editAction() {
        $grant = $this->saveModel(new Grant(), 'Application\Forms\GrantForm');
        $this->view->assign('grant', $grant);
    }

    public function scanAction() {
        $grants = $this->grantScanner();
        $this->view->assign('new', $grants['new']);
        $this->view->assign('deleted', $grants['deleted']);
        // @TODO add message with the number of saved grants
    }

    public function deleteAction() {
        // @TODO implement this method
    }
}