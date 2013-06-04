<?php
namespace RBMVC\Core\Model;

class Entry extends AbstractModel {
    
    /**
     * @var string 
     */
    private $author;
        
    /**
     * @var string 
     */
    private $date;
        
    /**
     * @var string 
     */
    private $title;
        
    /**
     * @var string 
     */
    private $text;
    
    /**
     * @return string
     */
    public function getAuthor() {
        return $this->author;
    }
    
    /**
     * @param string $author
     * @return \RBMVC\Model\Entry
     */
    public function setAuthor($author) {
        $this->author = $author;
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
     * @return \RBMVC\Model\Entry
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
     * @return \RBMVC\Model\Entry
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
     * @return \RBMVC\Model\Entry
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }

    /**
     * @return boolean / Entry
     */
    public function save() {
        $query = $this->db->getQuery($this->dbTable);
        if (empty($this->id)) {
            $sql = '
                INSERT INTO ' . $this->dbTable . ' 
                    (author, title, text, date) 
                VALUES 
                    (:author, :title, :text, NOW())';
            
            $param = array(
                ':author'   => $this->author,
                ':title'    => $this->title,
                ':text'     => $this->text,
            );
            
            $query->setSql($sql);
            $query->setParams($param);
        } else {
            $query->update();
            $query->set($this->toArray());
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
