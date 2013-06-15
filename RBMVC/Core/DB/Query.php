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
     * @return void
     */
    public function select(array $columns = array()) {
        $sql = 'SELECT %sFROM ' . $this->dbTable . ' ';
        
        $select = '* ';
        if (!empty($columns)) {
            $select = '';
            foreach ($columns as $column) {
                $select.= $column . ' ';
            }
        }
        
        $this->sql = sprintf($sql, $select);
    }

    /**
     * @return void
     */
    public function delete() {
        $this->sql = 'DELETE FROM ' . $this->dbTable . ' ';
    }
    
    /**
     * @return void
     */
    public function update() {
        $this->sql = 'UPDATE ' . $this->dbTable . ' ';
    }
    
    /**
     * @param array $where
     * @return void
     */
    public function where(array $where) {
        $sql = 'WHERE 1=1 ';
        foreach ($where as $key => $value) {
            $sql .= 'AND ' . $key . ' = :' . $key;
            $this->params[':' . $key] = $value;
        }
        $sql .= ' ';
        $this->sql .= $sql;
    }
    
    /**
     * @param array $orderBy
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
    
    /**
     * @param array $params
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
            $this->params[':' . $column] = $value;
        }
        $sql .= ' ';
        
        $this->sql .= $sql;
    }
}