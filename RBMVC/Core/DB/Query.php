<?php
namespace RBMVC\Core\DB;

class Query {

    /**
     * @var string
     */
    private $dbTable;

    /**
     * @var string
     */
    private $sql;

    /**
     * @var array
     */
    private $params = array();

    /**
     * @param string $dbTable
     *
     * @return void
     */
    public function setDBTable($dbTable) {
        $this->dbTable = $dbTable;
    }

    /**
     * @return string
     */
    public function getDBTable() {
        return $this->dbTable;
    }

    /**
     * @param string $sql
     *
     * @return void
     */
    public function setSql($sql) {
        $this->sql = $sql;
    }

    /**
     * @return string
     */
    public function getSQL() {
        return $this->sql;
    }

    /**
     * @param array $params
     *
     * @return void
     */
    public function setParams(array $params) {
        $this->params = $params;
    }

    /**
     * @return array
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * @param array $columns
     *
     * @return void
     */
    public function select(array $columns = array()) {
        $sql = 'SELECT %sFROM `' . $this->dbTable . '` ';

        $select = '* ';
        if (!empty($columns)) {
            $select = '';
            foreach ($columns as $column) {
                $select .= '`' . $column . '` ';
            }
        }

        $this->sql = sprintf($sql, $select);
    }

    /**
     * @return void
     */
    public function delete() {
        $this->sql = 'DELETE FROM `' . $this->dbTable . '` ';
    }

    /**
     * @return void
     */
    public function update() {
        $this->sql = 'UPDATE `' . $this->dbTable . '` ';
    }

    /**
     * @param array $where
     *
     * @return void
     */
    public function where(array $where) {
        $sql = 'WHERE 1=1';
        $i   = 0;

        foreach ($where as $key => $value) {
            $i++;
            if (is_array($value)) {
                foreach ($value as $i => $val) {
                    if ($i == 0) {
                        $sql .= ' AND `' . $key . '` = :' . $i . $key;
                    } else {
                        $sql .= ' OR `' . $key . '` = :' . $i . $key;
                    }
                    $this->params[':' . $i . $key] = $val;
                    $i++;
                }
            } else {
                $sql .= ' AND `' . $key . '` = :' . $i . $key;
                $this->params[':' . $i . $key] = $value;
            }
        }
        $sql .= ' ';
        $this->sql .= $sql;
    }

    /**
     * @param array $orderBy
     *
     * @return void
     */
    public function orderBy(array $orderBy) {
        $sql = 'ORDER BY ';

        $orderColumns = array_keys($orderBy);
        foreach ($orderBy as $column => $order) {
            $sql .= $column;

            if (strtolower($order) === 'desc') {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }

            if ($column != end($orderColumns)) {
                $sql .= ', ';
            }
        }
        $this->sql .= $sql;
    }

    public function insert(array $params) {
        $insert  = 'INSERT INTO `' . $this->dbTable . '` (';
        $values  = ' VALUES (';
        $columns = array_keys($params);
        foreach ($columns as $column) {
            $insert .= $column;
            $values .= ':' . $column;
            if ($column != end($columns)) {
                $insert .= ', ';
                $values .= ', ';
            } else {
                $insert .= ')';
                $values .= ')';
            }
        }

        $this->setPdoParams($params);
        $this->sql .= $insert . $values;
    }

    /**
     * @param array $params
     *
     * @return void
     */
    public function set(array $params) {
        $sql = 'SET ';

        if (array_key_exists('id', $params)) {
            unset($params['id']);
        }

        $orderColumns = array_keys($params);
        foreach ($params as $column => $value) {
            $sql .= $column . ' = :' . $column;
            if ($column != end($orderColumns)) {
                $sql .= ', ';
            }
        }
        $sql .= ' ';

        $this->setPdoParams($params);
        $this->sql .= $sql;
    }

    private function setPdoParams(array $params) {
        foreach ($params as $column => $value) {
            $this->params[':' . $column] = $value;
        }
    }

    public function reset() {
        $this->sql    = '';
        $this->params = array();
    }
}