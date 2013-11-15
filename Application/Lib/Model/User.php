<?php
namespace Application\Lib\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class User
 * @package \Application\Lib\Model
 */
class User extends AbstractModel {

    /**
     * @var string
     */
    protected $username = '';

    /**
     * @var string
     */
    protected $password = '';

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var UserGroup[]
     */
    protected $useGroups = array();

    /**
     * @param UserGroup[] $useGroups
     *
     * @return User
     */
    public function setUseGroups($useGroups) {
        $this->useGroups = $useGroups;

        return $this;
    }

    /**
     * @return UserGroup[]
     */
    public function getUseGroups() {
        return $this->useGroups;
    }

    /**
     * @var boolean
     */
    protected $isActive = false;

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsActive() {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     *
     * @return User
     */
    public function setIsActive($isActive) {
        $this->isActive = (bool) $isActive;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return $this->isActive;
    }

}