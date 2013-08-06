<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 17:25
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\Session;

class HasAccess extends AbstractViewHelper {

    /**
     * @var array
     */
    private $grants = array();

    public function __construct() {
        $session = new Session('user');
        /** @var \Application\Model\LoggedInUser $user */
        $user         = $session->user;
        $this->grants = $user->getGrants();
    }

    /**
     * @param $definition
     *
     * @return bool
     */
    public function hasAccess($definition) {
        $definition = preg_replace('/\?.*/', '', $definition);

        return in_array($definition, $this->grants);
    }

}