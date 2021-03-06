<?php
namespace RBMVC\Core\Model\Collection;

use RBMVC\Core\DB\DB;
use RBMVC\Core\DB\Query;
use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Modifiers\String\GetClassNameWithUnderscore;

/**
 * Class AbstractCollection
 * @package RBMVC\Core\Model\Collection
 */
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
     * @var AbstractModel[]
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

    /**
     *
     */
    public function __construct() {
        $this->db = DB::getInstance();

        $converter     = new GetClassNameWithUnderscore();
        $className     = $converter->getClassName($this);
        $this->dbTable = str_replace('_collection', '', $className);
        $this->models  = array();
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
     * @return void
     */
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
    public function getIndexParams() {
        return $this->indexParams;
    }

    /**
     * @param array $indexParams
     *
     * @return AbstractCollection
     */
    public function setIndexParams(array $indexParams) {
        $this->indexParams = $indexParams;

        return $this;
    }

    /**
     * @return AbstractModel[]
     */
    public function getModels() {
        if (empty($this->models) && !empty($this->result)) {
            $this->fill($this->result);
        }

        return $this->models;
    }

    /**
     * @return array
     */
    public function getResult() {
        return $this->result;
    }

    /**
     * @param $result
     *
     * @return AbstractCollection
     */
    public function setResult(array $result) {
        $this->result = $result;

        return $this;
    }

    /**
     * @param Query $query
     */
    protected function fetch(Query $query) {
        $stmt         = $this->db->execute($query);
        $this->result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param array $result
     *
     * @return void
     */
    abstract protected function fill(array $result);
}
