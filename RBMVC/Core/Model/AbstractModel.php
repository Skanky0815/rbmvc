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
    public function delete() {
        $query = $this->db->getQuery($this->dbTable);
        $query->delete();
        $query->where(array('id' => $this->id));
        $this->db->execute($query);

        $i81n = new I18n();
        $i81n->setClassname($this->dbTable)->setObjectId($this->id)->delete();
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
                $value                 = $this->{$methodName}();
                if (is_array($value) && !empty($value) && reset($value) instanceof AbstractModel) {
                    foreach ($value as $i => $val) {
                        /** @var AbstractModel $val */
                        $value[$i] = $val->toArray();
                    }
                }
                $array[$key] = $value;
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

        $camelCaseToUnderscore = new CamelCaseToUnderscore();

        $columns = $this->getTableDefinitions();
        $array   = array();
        foreach ($properties as $property) {
            $propertyName = $camelCaseToUnderscore->convert($property->getName());
            if (!isset($columns[$propertyName])) {
                continue;
            }

            $methodName = 'get' . ucfirst($property->getName());
            if ($reflectionClass->hasMethod($methodName)) {
                $array[$propertyName] = $this->{$methodName}();
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

    /**
     * @param string $fieldName
     *
     * @return string
     */
    protected function loadTexts($fieldName) {
        $getClassNameWithUnderscore = new GetClassNameWithUnderscore();
        $className = $getClassNameWithUnderscore->getClassName($this);

        $i18n = new I18n();
        $i18n->setClassname($className)
            ->setField($fieldName)
            ->setLanguageId(1) // TODO use there the current language!!!
            ->setObjectId($this->id)
            ->init();

        return $i18n->getValue();
    }

}