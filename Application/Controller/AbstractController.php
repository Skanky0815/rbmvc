<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 09:55
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller;

use Application\Model\User;
use RBMVC\Core\Utilities\Session;

abstract class AbstractController extends \RBMVC\Core\Controller\AbstractController {

    /**
     * @var User
     */
    protected $user;

    public function init() {
        parent::init();

        $this->setUser();
    }

    /**
     * @TODO outsource this into a auth setup class
     * @return void
     */
    public function setUser() {
        $session  = new Session('user');
        $userData = $session->user;

        $user = new User();
        if (is_array($userData)) {
            $user->fillModelByArray($userData);
        }

        $this->user = $user;
        $this->view->assign('loggedUser', $this->user);
    }

}