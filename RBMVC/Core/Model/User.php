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

}