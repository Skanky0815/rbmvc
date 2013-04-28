<?php
namespace core\rbmvc\model;

use core\rbmvc\model\AbstractModel;

class Entry extends AbstractModel {
    
    private $author;
    
    private $date;
    
    private $title;
    
    private $text;
    
    public function __construct() {
        parent::__construct('entry');
    }

    public function getAuthor() {
        return $this->author;
    }
    
    public function setAuthor($author) {
        $this->author = $author;
        return $this;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getText() {
        return $this->text;
    }
    
    public function setText($text) {
        $this->text = $text;
        return $this;
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
    
    public function fillModelByArray(array $modelData) {
        $this->id = (int) isset($modelData['id']) ? $modelData['id'] : 0;
        $this->author = isset($modelData['author']) ? $modelData['author'] : '';
        $this->date = isset($modelData['date']) ? $modelData['date'] : '';
        $this->title = isset($modelData['title']) ? $modelData['title'] : '';
        $this->text = isset($modelData['text']) ? $modelData['text'] : '';
        
    }
    
    public function toArray() {
        return
            array('id'      => $this->id
                , 'author'  => $this->author
                , 'date'    => $this->date
                , 'title'   => $this->title
                , 'text'    => $this->text
           );
    }
 

}
