<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 14:59
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class UserGroup
 * @package Application\Model
 */
class UserGroup extends AbstractModel {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var array
     */
    private $grantTypes;

    /**
     * @param $description
     *
     * @return \Application\Model\UserGroup
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param array $grantTypes
     *
     * @return \Application\Model\UserGroup
     */
    public function setGrantTypes(array $grantTypes) {
        $this->grantTypes = $grantTypes;

        return $this;
    }

    /**
     * @return array
     */
    public function getGrantTypes() {
        return $this->grantTypes;
    }

    /**
     * @param $name
     *
     * @return \Application\Model\UserGroup
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

}