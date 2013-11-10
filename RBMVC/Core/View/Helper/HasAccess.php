<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 17:25
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\Access;

/**
 * Class HasAccess
 * @package RBMVC\Core\View\Helper
 */
class HasAccess extends AbstractViewHelper {

    /**
     * @var Access
     */
    private $access;

    public function __construct() {
        $this->access = new Access();
    }

    /**
     * @param $definition
     *
     * @return bool
     */
    public function hasAccess($definition) {
        return $this->access->hasAccess($definition);
    }

}