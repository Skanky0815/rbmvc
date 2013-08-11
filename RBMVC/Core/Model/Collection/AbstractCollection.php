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
    protected $models = array();

    /**
     * @var array
     */
    protected $result = array();

    /**
     * @var array
     */
    protected $indexParams = array();

    public function __construct() {
        $this->db = DB::getInstance();

        $converter     = new GetClassNameWithUnderscore();
        $className     = $converter->getClassName($this);
        $this->dbTable = str_replace('_collection', '', $className);
        $this->models  = array();
    }

    /**
     * @param array $indexParams
     *
     * @return \RBMVC\Core\Model\Collection\AbstractCollection
     */
    public function setIndexParams(array $indexParams) {
        $this->indexParams = $indexParams;

        return $this;
    }

    /**
     * @return array
     */
    public function getIndexParams() {
        return $this->indexParams;
    }

    /**
     * @param $result
     *
     * @return \RBMVC\Core\Model\Collection\AbstractCollection
     */
    public function setResult(array $result) {
        $this->result = $result;

        return $this;
    }

    /**
     * @return array
     */
    public function getResult() {
        return $this->result;
    }

    protected function fetch(Query $query) {
        $stmt         = $this->db->execute($query);
        $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
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

    public function findForIndex() {
        $query = $this->db->getQuery($this->dbTable);
        $query->select(array('id'));
        $query->orderBy(array($this->indexParams['order_by'] => $this->indexParams['order_dir']));
        $query->limit($this->indexParams['limit']);

        $offset = $this->indexParams['page'] * $this->indexParams['limit'] - $this->indexParams['limit'];
        $query->offset($offset);

        $this->fetch($query);
    }

    /**
     * @return array
     */
    public function getModels() {
        if (empty($this->models) && !empty($this->result)) {
            $this->fill($this->result);
        }

        return $this->models;
    }

    /**
     * @param array $result
     *
     * @return void
     */
    abstract protected function fill(array $result);
}
