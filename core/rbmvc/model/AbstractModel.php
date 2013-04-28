<?php
namespace core\rbmvc\model;

use core\rbmvc\db\DB;

abstract class AbstractModel {
    
    protected $id;
    
    protected $db;
    
    protected $dbTable;
    
    public function __construct($dbTable) {
        $this->db = DB::getInstance();
        $this->dbTable = $dbTable;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }
    
    abstract public function save(); 
        
    public function delete() {
        $query = 'DELETE FROM ' . $this->dbTable . ' WHERE id = ' . $this->id; 
        $this->db->query($query);
    }
    
    public function init() {
        if (!is_int($this->id) || $this->id <= 0) {
            return false;
        }
        $query = 'SELECT * FROM ' . $this->dbTable . ' WHERE id = ' . $this->id;
        $result = $this->db->fetch($query);
        $this->fillModelByArray($result);
    }
    
    abstract public function toArray();
    
    abstract public function fillModelByArray(array $modelData);
    
}
