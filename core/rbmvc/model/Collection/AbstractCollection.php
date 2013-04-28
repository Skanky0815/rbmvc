<?php
namespace core\rbmvc\model\collection;

use core\rbmvc\db\DB;

abstract class AbstractCollection {
    
    protected $db;
    
    protected $dbTable;
    
    protected $models;
    
    public function __construct($dbTable) {
        $this->db = DB::getInstance();
        $this->dbTable = $dbTable;
        
        $this->models = array();
    }
    
    abstract public function findAll();
    
    public function getModels() {
        return $this->models;
    }
}
