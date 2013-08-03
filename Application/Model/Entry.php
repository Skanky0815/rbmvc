<?php
namespace Application\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class Entry
 * @package Application\Model
 */
class Entry extends AbstractModel {
    
    /**
     * @var int
     * @column user_id
     */
    private $userId;

    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     * @column date
     */
    private $date;
        
    /**
     * @var string
     * @column title
     */
    private $title;
        
    /**
     * @var string
     * @column text
     */
    private $text;
    
    /**
     * @return string
     */
    public function getUserId() {
        return $this->userId;
    }
    
    /**
     * @param string $author
     * @return \Application\Model\Entry
     */
    public function setUserId($author) {
        $this->userId = $author;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getDate() {
        return $this->date;
    }
    
    /**
     * @param string $date
     * @return \Application\Model\Entry
     */
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return \Application\Model\Entry
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }
    
    /**
     * @param string $text
     * @return \Application\Model\Entry
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * @return \Application\Model\User
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param \Application\Model\User $user
     *
     * @return \Application\Model\Entry
     */
    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    /**
     * @return bool
     */
    public function init() {
        $isInit = parent::init();

        if ($isInit) {
            $user = new User();
            $user->setId($this->userId)->init();

            $this->user = $user;
            return true;
        }

        return false;
    }

    /**
     * @return boolean|\Application\Model\Entry
     */
    public function save() {
        $query = $this->db->getQuery($this->dbTable);
        if (empty($this->id)) {
            $sql = '
                INSERT INTO ' . $this->dbTable . ' 
                    (user_id, title, text, date)
                VALUES 
                    (:user_id, :title, :text, NOW())';
            
            $param = array(
                ':user_id'   => $this->userId,
                ':title'    => $this->title,
                ':text'     => $this->text,
            );
            
            $query->setSql($sql);
            $query->setParams($param);
        } else {
            $query->update();
            $query->set($this->toArrayForSave());
            $query->where(array('id' => $this->id));
        }

        $this->db->execute($query);
        
        if (empty($this->id)) {
            $this->id = $this->db->lastInsertId();
        }
        
        $this->init();
        return $this;
    }

}
