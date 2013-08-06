<?php
namespace Application\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class User
 * @package Application\Model
 */
class User extends AbstractModel {

    /**
     * @var string
     * @column username
     */
    protected $username;

    /**
     * @var string
     * @column password
     */
    protected $password;

    /**
     * @var string
     * @column password
     */
    protected $email;

    /**
     * @var array
     */
    protected $useGroups;

    /**
     * @var boolean
     * @column is_active
     */
    protected $isActive = false;

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return \Application\Model\User
     */
    public function setUsername($username) {
        $this->username = $username;

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
     * @return \Application\Model\User
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return \Application\Model\User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return $this->isActive;
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
     * @return \Application\Model\User
     */
    public function setIsActive($isActive) {
        $this->isActive = (bool) $isActive;

        return $this;
    }

}