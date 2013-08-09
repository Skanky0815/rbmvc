<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 09.08.13
 * Time: 22:29
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Controller\Plugins;

use Application\Lib\Model\LoggedInUser;
use RBMVC\Core\Controller\AbstractPlugin;
use RBMVC\Core\Request;
use RBMVC\Core\Utilities\Session;

/**
 * Class UserSetup
 * @package Application\Lib\Controller\Plugin
 */
class UserSetup extends AbstractPlugin {

    /**
     * @param Request $request
     *
     * @return void
     */
    public function onBootstrap(Request $request) {
        $session = new Session('user');
        $user    = $session->user;

        if (is_null($user)) {
            $user          = new LoggedInUser();
            $session->user = $user;
        }
    }

}