<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 09.08.13
 * Time: 22:05
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities;

use Application\Lib\Model\LoggedInUser;

/**
 * Class Access
 * @package RBMVC\Core\Utilities
 */
class Access {

    /**
     * @var array
     */
    private $grants = array();

    /**
     * @param string|array $definition
     *
     * @return bool
     */
    public function hasAccess($definition) {
        if (empty($this->grants)) {
            $this->setGrants();
        }

        $hasAccess = false;
        if (is_array($definition)) {
            $hasAccess = $this->hasAccessByArray($definition);
        } else if (is_string($definition)) {
            $hasAccess = $this->hasAccessByString($definition);
        }

        return $hasAccess;
    }

    /**
     * @param array $definition
     *
     * @return bool
     */
    private function hasAccessByArray(array $definition) {
        if (!isset($definition['controller']) || !isset($definition['action'])) {
            return false;
        }

        return $this->hasAccessByString('/' . $definition['controller'] . '/' . $definition['action']);
    }

    /**
     * @param string $definition
     *
     * @return bool
     */
    private function hasAccessByString($definition) {
        $definition = preg_replace('/\?.*/', '', $definition);

        return in_array($definition, $this->grants);
    }

    /**
     * @return void
     */
    private function setGrants() {
        $session = new Session('user');

        /** @var \Application\Lib\Model\LoggedInUser $user */
        $user = $session->user;
        if ($user instanceof LoggedInUser) {
            $this->grants = $user->getGrants();
        }
    }

}