<?php
namespace RBMVC\Core\Model;

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
    private $isActive;
    
    /**
     * @return void
     */
    public function __construct() {
        parent::__construct('user');
    }
    
    /**
     * @param array $modelData
     * @return void
     */
    public function fillModelByArray(array $modelData) {
        $this->id = (int) isset($modelData['id']) ? $modelData['id'] : 0;
        $this->username = isset($modelData['username']) ? $modelData['username'] : '';
        $this->password = isset($modelData['password']) ? $modelData['password'] : '';
        $this->email = isset($modelData['email']) ? $modelData['email'] : '';
        $this->useGroups = isset($modelData['user_groups']) ? $modelData['user_groups'] : '';
        $this->isActive = (bool) isset($modelData['is_active']) ? $modelData['is_active'] : '';
    }

    /**
     * @return void
     */
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

    /**
     * @return array
     */
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