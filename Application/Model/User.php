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
    private $username;
        
    /**
     * @var string
     * @column password
     */
    private $password;
        
    /**
     * @var string
     * @column password
     */
    private $email;
        
    /**
     * @var array
     */
    private $useGroups;
        
    /**
     * @var boolean
     * @column is_active
     */
    private $isActive = false;

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
     * @return \Application\Model\User
     */
    public function setIsActive($isActive) {
        $this->isActive = (bool) $isActive;
        return $this;
    }

    /**
     * @return bool
     */
    public function exists() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select();
        $query->where(array('password' => $this->password, 'username' => $this->username));

        $stmt = $this->db->execute($query);
        if (is_null($stmt)) {
            return false;
        }
        
        $result = $stmt->fetch();
        
        if (empty($result)) {
            return false;
        }
        
        $this->fillModelByArray($result);
        return true;
    }

}