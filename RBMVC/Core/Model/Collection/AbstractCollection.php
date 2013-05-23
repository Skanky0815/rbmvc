<?php
namespace RBMVC\Core\Model\Collection;

use RBMVC\Core\DB\DB;

abstract class AbstractCollection {
    
    /**
     * @var DB
     */
    protected $db;
    
    /**
     * @var string 
     */
    protected $dbTable;
    
    /**
     * @var array 
     */
    protected $models;
    
    /**
     * @param string $dbTable
     * @return void
     */
    public function __construct($dbTable) {
        $this->db = DB::getInstance();
        $this->dbTable = $dbTable;
        
        $this->models = array();
    }
    
    /**
     * @return void
     */
    abstract public function findAll();
    
    /**
     * @return array
     */
    public function getModels() {
        return $this->models;
    }
}
