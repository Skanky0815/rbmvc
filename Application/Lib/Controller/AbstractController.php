<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 09:55
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Controller;

use Application\Lib\Model\User;
use RBMVC\Core\Utilities\Session;

/**
 * Class AbstractController
 * @package Application\Lib\Controller
 */
abstract class AbstractController extends \RBMVC\Core\Controller\AbstractController {

    /**
     * @var \Application\Lib\Model\User
     */
    protected $user;

    /**
     * @return void
     */
    public function init() {
        parent::init();

        $session    = new Session('user');
        $this->user = $session->user;
        $this->view->assign('loggedUser', $this->user);
    }

}