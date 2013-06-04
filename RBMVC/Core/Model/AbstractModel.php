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
    public function __construct() {
        $this->db = DB::getInstance();
        
        $reflectionClass = new \ReflectionClass($this);
        $classNameParts = explode('\\', $reflectionClass->getName());
        $className = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2',  end($classNameParts)));
        $this->dbTable = $className;
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
    public final function delete() {
        $query = $this->db->getQuery($this->dbTable);
        $query->delete();
        $query->where(array('id' => $this->id));
        $this->db->execute($query);
    }
    
    /**
     * @return boolean
     */
    public final function init() {
        if (!is_int($this->id) || $this->id <= 0) {
            return false;
        }
        
        $query = $this->db->getQuery($this->dbTable);
        $query->select();
        $query->where(array('id' => $this->id));

        $stmt = $this->db->execute($query);
        $result = $stmt->fetch();
        
        if (empty($result)) {
            return false;
        }
        
        $this->fillModelByArray($result);
        return true;
    }
    
    /**
     * @return array
     */
    public final function toArray() {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties();
        $array = array();
        /* @var $property \ReflectionProperty */
        foreach ($properties as $property) {
            $methodName = 'get' . ucfirst($property->getName());
            if ($reflectionClass->hasMethod($methodName)) {
                $key = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $property->getName()));
                $array[$key] = $this->{$methodName}();
            }
        }
        return $array;
    }
    
    /**
     * @param array $modelData
     * @return void
     */
    public final function fillModelByArray(array $modelData) {
        $reflectionClass = new \ReflectionClass($this);
        $properties = $reflectionClass->getProperties();
        
        /* @var $property \ReflectionProperty */
        foreach ($properties as $property) {
            $key = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $property->getName()));
            if (!key_exists($key, $modelData)) {
                continue;
            }
            
            $methodName = 'set' . ucfirst($property->getName());
            if ($reflectionClass->hasMethod($methodName)) {
                $this->{$methodName}($modelData[$key]);
            }
        }
    }
    
}