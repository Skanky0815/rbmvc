<?php
namespace RBMVC\Core\Model;

use RBMVC\Core\DB\DB;

abstract class AbstractModel {
    
    /**
     * @var integer
     */
    protected $id;
    
    /**
     * @var DB
     */
    protected $db;
    
    /**
     * @var string 
     */
    protected $dbTable;
    
    /**
     * @param string $dbTable
     * @return void
     */
    public function __construct($dbTable) {
        $this->db = DB::getInstance();
        $this->dbTable = $dbTable;
    }
    
    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param integer $id
     * @return \RBMVC\Model\AbstractModel
     */
    public function setId($id) {
        $this->id = (int) $id;
        return $this;
    }
    
    /**
     * @return void
     */
    abstract public function save(); 
        
    /**
     * @return void
     */
    public function delete() {
        $sql = 'DELETE FROM ' . $this->dbTable . ' WHERE id = :id'; 
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(':id' => $this->id));
        } catch (\PDOException $e) {
            error_log(__METHOD__.'::> '.$e->getMessage());
        }
    }
    
    /**
     * @return boolean
     */
    public function init() {
        if (!is_int($this->id) || $this->id <= 0) {
            return false;
        }
        
        $sql = 'SELECT * FROM ' . $this->dbTable . ' WHERE id = :id';

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array(':id' => $this->id));
            $result = $stmt->fetch();
        } catch (\PDOException $e) {
            error_log(__METHOD__.'::> '.$e->getMessage());
            return false;
        }
        
        if (empty($result)) {
            return false;
        }
        
        $this->fillModelByArray($result);
        return true;
    }
    
    /**
     * @return array
     */
    abstract public function toArray();
    
    /**
     * @return void
     */
    abstract public function fillModelByArray(array $modelData);
    
}
