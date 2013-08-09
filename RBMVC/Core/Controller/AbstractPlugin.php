<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 17:22
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Controller;

use RBMVC\Core\Request;

/**
 * Class AbstractPlugin
 * @package RBMVC\Core\Controller
 */
abstract class AbstractPlugin {

    /**
     * @param Request $request
     *
     * @return void
     */
    abstract public function onBootstrap(Request $request);

}