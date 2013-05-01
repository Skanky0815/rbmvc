<?php
namespace core\rbmvc\model;

use core\rbmvc\model\AbstractModel;

class User extends AbstractModel {
    
    private $username;
    
    private $password;
    
    private $email;
    
    private $useGroups;
    
    private $isActive;
    
    public function __construct() {
        parent::__construct('user');
    }
    
    public function fillModelByArray(array $modelData) {
        $this->id = (int) isset($modelData['id']) ? $modelData['id'] : 0;
        $this->username = isset($modelData['username']) ? $modelData['username'] : '';
        $this->password = isset($modelData['password']) ? $modelData['password'] : '';
        $this->email = isset($modelData['email']) ? $modelData['email'] : '';
        $this->useGroups = isset($modelData['user_groups']) ? $modelData['user_groups'] : '';
        $this->isActive = (bool) isset($modelData['is_active']) ? $modelData['is_active'] : '';
    }

    public function save() {
        $query = '';
        if ($this->id == 0) {
            $query = '
                INSERT INTO ' . $this->dbTable . ' 
                    (author, title, text, date) 
                VALUES 
                    (\'' . $this->author . '\',
                     \'' . $this->title . '\',
                     \'' . $this->text . '\',
                      NOW())';
        } else {
            $query = '
                UPDATE ' . $this->dbTable . '
                SET
                    author = \'' . $this->author . '\',
                    title = \'' . $this->title . '\',
                    text = \''. $this->text . '\'
                WHERE 
                    id = ' . $this->id;
        }
        
        if (!empty($query)) {
            $this->db->query($query);
        }
    }

    public function toArray() {
        return
            array('id' => $this->id
                , 'username' => $this->username
                , 'password' => $this->password
                , 'user_groups' => $this->useGroups
                , 'is_active' => $this->isActive
        );
    }    
}