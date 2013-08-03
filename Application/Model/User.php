<?php
namespace Application\Model;

use RBMVC\Core\Model\AbstractModel;

class User extends AbstractModel {
        
    /**
     * @var string 
     */
    private $username;
        
    /**
     * @var string 
     */
    private $password;
        
    /**
     * @var string 
     */
    private $email;
        
    /**
     * @var string 
     */
    private $useGroups;
        
    /**
     * @var boolean 
     */
    private $isActive = false;
    
    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function isActive() {
        return $this->isActive;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($isActive) {
        $this->isActive = (bool) $isActive;
        return $this;
    }

    /**
     * @return void
     */
    public function save() {
        $sql = '';
        if ($this->id == 0) {
            $sql = '
                INSERT INTO ' . $this->dbTable . ' 
                    (author, title, text, date) 
                VALUES 
                    (\'' . $this->author . '\',
                     \'' . $this->title . '\',
                     \'' . $this->text . '\',
                      NOW())';
        } else {
            $sql = '
                UPDATE ' . $this->dbTable . '
                SET
                    author = \'' . $this->author . '\',
                    title = \'' . $this->title . '\',
                    text = \''. $this->text . '\'
                WHERE 
                    id = ' . $this->id;
        }
        
    }
    
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