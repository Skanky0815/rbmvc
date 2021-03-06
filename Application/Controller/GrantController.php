<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:07
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller;

use Application\Lib\Controller\AbstractRudiController;

/**
 * Class GrantController
 * @package Application\Controller
 */
class GrantController extends AbstractRudiController {

    public function __construct() {
        parent::__construct('Grant');
    }

    /**
     * @return void
     */
    public function scanAction() {
        $grants = $this->grantScanner();
        $this->view->assign('new', $grants['new']);
        $this->view->assign('deleted', $grants['deleted']);
    }

}