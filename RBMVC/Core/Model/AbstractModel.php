<?php
namespace RBMVC\Core\Model;

use RBMVC\Core\DB\DB;
use RBMVC\Core\Utilities\Modifiers\String\CamelCaseToUnderscore;
use RBMVC\Core\Utilities\Modifiers\String\GetClassNameWithUnderscore;

/**
 * Class AbstractModel
 * @package RBMVC\Core\Model
 */
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
     *
     */
    public function __construct() {
        $this->db = DB::getInstance();

        $converter     = new GetClassNameWithUnderscore();
        $this->dbTable = $converter->getClassName($this);
    }

    /**
     * @return boolean
     */
    public function init() {
        if (!is_int($this->id) || $this->id <= 0) {
            return false;
        }

        $query = $this->db->getQuery($this->dbTable);
        $query->select();
        $query->where(array('id' => $this->id));

        $stmt   = $this->db->execute($query);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        $this->fillModelByArray($result);

        return true;
    }

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
     * @param array $modelData
     *
     * @return void
     */
    public final function fillModelByArray(array $modelData) {
        $reflectionClass = new \ReflectionClass($this);
        $properties      = $reflectionClass->getProperties();

        foreach ($properties as $property) {
            $camelCaseToUnderscore = new CamelCaseToUnderscore();
            $key                   = $camelCaseToUnderscore->convert($property->getName());
            if (!array_key_exists($key, $modelData)) {
                continue;
            }

            $methodName = 'set' . ucfirst($property->getName());
            if ($reflectionClass->hasMethod($methodName)) {
                $this->{$methodName}($modelData[$key]);
            }
        }
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param integer $id
     *
     * @return AbstractModel
     */
    public function setId($id) {
        $this->id = (int) $id;

        return $this;
    }

    /**
     * @return AbstractModel
     */
    public function save() {
        $query = $this->db->getQuery($this->dbTable);
        if (empty($this->id)) {
            $query->insert($this->toArrayForSave());
        } else {
            $query->update();
            $query->set($this->toArrayForSave());
            $query->where(array('id' => $this->id));
        }

        $this->db->execute($query);

        if (empty($this->id)) {
            $this->id = $this->db->lastInsertId();
        }

        if (!$this->init()) {
            return false;
        }

        return $this;
    }

    /**
     * @return array
     */
    public final function toArray() {
        $reflectionClass = new \ReflectionClass($this);
        $properties      = $reflectionClass->getProperties();
        $array           = array();
        foreach ($properties as $property) {
            $methodName = 'get' . ucfirst($property->getName());
            if ($reflectionClass->hasMethod($methodName)) {
                $camelCaseToUnderscore = new CamelCaseToUnderscore();
                $key                   = $camelCaseToUnderscore->convert($property->getName());
                $array[$key]           = $this->{$methodName}();
            }
        }

        return $array;
    }

    /**
     * @return array
     */
    public final function toArrayForSave() {
        $reflectionClass = new \ReflectionClass($this);
        $properties      = $reflectionClass->getProperties();

        $columns = $this->getTableDefinitions();
        $array   = array();
        foreach ($properties as $property) {
            if (!isset($columns[$property->getName()])) {
                continue;
            }

            $methodName = 'get' . ucfirst($property->getName());
            if ($reflectionClass->hasMethod($methodName)) {
                $camelCaseToUnderscore = new CamelCaseToUnderscore();
                $key                   = $camelCaseToUnderscore->convert($property->getName());
                $array[$key]           = $this->{$methodName}();
            }
        }

        return $array;
    }

    /**
     * @return array
     */
    private function getTableDefinitions() {
        $query = $this->db->getQuery($this->dbTable);
        $query->getTableDefinition();
        $stmt = $this->db->execute($query);

        $tableColumns = array();
        foreach ($stmt->fetchAll(\PDO::FETCH_ASSOC) as $column) {
            $tableColumns[$column['Field']] = $column;
        }

        return $tableColumns;
    }

}