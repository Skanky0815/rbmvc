<?php
namespace RBMVC\Core\Model\Collection;

use RBMVC\Core\DB\DB;
use RBMVC\Core\DB\Query;
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

    public function __construct() {
        $this->db = DB::getInstance();

        $converter     = new GetClassNameWithUnderscore();
        $className     = $converter->getClassName($this);
        $this->dbTable = str_replace('_collection', '', $className);
        $this->models  = array();
    }

    protected function fetch(Query $query) {
        $stmt   = $this->db->execute($query);
        $result = $stmt->fetchAll();
        if (empty($result)) {
            return;
        }

        $this->fill($result);
    }

    /**
     * @return void
     */
    public function findAll() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->orderBy(array('id' => 'DESC'));
        $this->fetch($query);
    }

    /**
     * @return array
     */
    public function getModels() {
        return $this->models;
    }

    /**
     * @param array $result
     *
     * @return void
     */
    abstract protected function fill(array $result);
}
