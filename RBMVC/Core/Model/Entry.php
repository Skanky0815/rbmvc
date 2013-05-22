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
     * @return void
     */
    public function __construct() {
        parent::__construct('entry');
    }

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
                    author  = \'' . $this->author . '\',
                    title   = \'' . $this->title . '\',
                    text    = \''. $this->text . '\'
                WHERE 
                    id      = ' . $this->id;
        }
        
        if (!empty($query)) {
            $this->db->query($query);
        }
    }
    
    /**
     * @param array $modelData
     * @return void
     */
    public function fillModelByArray(array $modelData) {
        $this->id = (int) isset($modelData['id']) ? $modelData['id'] : 0;
        $this->author = isset($modelData['author']) ? $modelData['author'] : '';
        $this->date = isset($modelData['date']) ? $modelData['date'] : '';
        $this->title = isset($modelData['title']) ? $modelData['title'] : '';
        $this->text = isset($modelData['text']) ? $modelData['text'] : '';
    }
    
    /**
     * @return array
     */
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
