<?php
namespace RBMVC\Core\Model\Collection;

use RBMVC\Core\DB\DB;
use RBMVC\Core\Utilities\Modifiers\String\GetClassNameWithUnderscore;

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
    public function __construct() {
        $this->db = DB::getInstance();
        
        $converter = new GetClassNameWithUnderscore();
        $className = $converter->getClassName($this);
        $this->dbTable = str_replace('_collection', '', $className);
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
