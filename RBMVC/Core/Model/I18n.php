<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.02.14
 * Time: 00:02
 */

namespace RBMVC\Core\Model;


/**
 * Class I18n
 * @package RBMVC\Core\Model
 */
class I18n extends AbstractModel {

    /**
     * @var int
     */
    private $objectId = 0;

    /**
     * @var string
     */
    private $classname = '';

    /**
     * @var string
     */
    private $field = '';

    /**
     * @var string
     */
    private $value = '';

    /**
     * @var int
     */
    private $languageId = 0;

    /**
     * @return boolean
     */
    public function init() {
        if (!is_int($this->objectId) || $this->objectId <= 0 || empty($this->field) || empty($this->classname)
            || !is_int($this->languageId) || $this->languageId <= 0) {

            return false;
        }

        $query = $this->db->getQuery($this->dbTable);
        $query->select();
        $query->where(array(
            'object_id'   => $this->objectId,
            'field'       => $this->field,
            'classname'   => $this->classname,
            'language_id' => $this->languageId
        ));

        $stmt   = $this->db->execute($query);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (empty($result)) {
            return false;
        }

        $this->fillModelByArray($result);

        return true;
    }

    /**
     * override delete method for deleting data by $classname and $object_id
     *
     * @return void
     */
    public function delete() {
        $query = $this->db->getQuery($this->dbTable);
        $query->delete();
        $query->where(array('classname' => $this->classname, 'object_id' => $this->objectId));
        $this->db->execute($query);
    }

    /**
     * @param string $classname
     *
     * @return I18n
     */
    public function setClassname($classname) {
        $this->classname = $classname;

        return $this;
    }

    /**
     * @return string
     */
    public function getClassname() {
        return $this->classname;
    }

    /**
     * @param string $field
     *
     * @return I18n
     */
    public function setField($field) {
        $this->field = $field;

        return $this;
    }

    /**
     * @return string
     */
    public function getField() {
        return $this->field;
    }

    /**
     * @param int $languageId
     *
     * @return I18n
     */
    public function setLanguageId($languageId) {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * @return int
     */
    public function getLanguageId() {
        return $this->languageId;
    }

    /**
     * @param string $value
     *
     * @return I18n
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue() {
//        isset($result['value']) ? $result['value'] : 'no texts found!'
        return $this->value;
    }

    /**
     * @param int $objectId
     *
     * @return I18n
     */
    public function setObjectId($objectId) {
        $this->objectId = $objectId;

        return $this;
    }

    /**
     * @return int
     */
    public function getObjectId() {
        return $this->objectId;
    }



} 