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
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var array
     */
    protected $useGroups;

    /**
     * @var boolean
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
     * @return \Application\Lib\Model\User
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
     * @return \Application\Lib\Model\User
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
     * @return \Application\Lib\Model\User
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
     * @return \Application\Lib\Model\User
     */
    public function setIsActive($isActive) {
        $this->isActive = (bool) $isActive;

        return $this;
    }

}