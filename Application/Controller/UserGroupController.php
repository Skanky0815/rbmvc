<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 14:57
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller;

use Application\Lib\Controller\AbstractRudiController;

/**
 * Class UserGroupController
 * @package Application\Controller
 */
class UserGroupController extends AbstractRudiController {

    /**
     * @return void
     */
    public function __construct() {
        parent::__construct('UserGroup');
    }

}