<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 09.08.13
 * Time: 22:04
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Controller\Plugins;

use RBMVC\Core\Controller\AbstractPlugin;
use RBMVC\Core\Request;

/**
 * Class Access
 * @package RBMVC\Core\Controller\Plugins
 */
class Access extends AbstractPlugin {

    /**
     * @param Request $request
     *
     * @return void
     */
    public function onBootstrap(Request $request) {
        $access = new \RBMVC\Core\Utilities\Access();
        if (!$access->hasAccess($request->getParams())) {
            die('you have no permission for this page');
        }
    }

}