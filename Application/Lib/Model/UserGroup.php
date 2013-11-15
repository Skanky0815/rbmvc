<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 14:59
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Model;

use Application\Lib\Model\UserGroup\GrantAssign;
use RBMVC\Core\Model\AbstractModel;

/**
 * Class UserGroup
 * @package Application\Model
 */
class UserGroup extends AbstractModel {

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var array
     */
    private $grantTypes = array();

    /**
     * @var Grant[]
     */
    private $grants = array();

    /**
     * @return bool
     */
    public function init() {
        if (!parent::init()) {
            return false;
        }

        $grantCollection = new GrantAssign();
        $grantCollection->findByUserGroupId($this->id);
        $this->grants = $grantCollection->getModels();

        return true;
    }

    /**
     * @return bool|AbstractModel
     */
    public function save() {
        $grants = $this->grants;
        if (!parent::save()) {
            return false;
        }
        $grantCollection = new GrantAssign();
        $grantCollection->deleteAllByUserGroupId($this->id);
        $grantCollection->save($this->id, $grants);
        $this->grants = $grantCollection->getModels();

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param $description
     *
     * @return UserGroup
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * @return array
     */
    public function getGrantTypes() {
        return $this->grantTypes;
    }

    /**
     * @param array $grantTypes
     *
     * @return UserGroup
     */
    public function setGrantTypes(array $grantTypes) {
        $this->grantTypes = $grantTypes;

        return $this;
    }

    /**
     * @return Grant[]
     */
    public function getGrants() {
        return $this->grants;
    }

    /**
     * @param Grant[] $grants
     *
     * @return UserGroup
     */
    public function setGrants($grants) {
        $this->grants = $grants;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param $name
     *
     * @return UserGroup
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

}