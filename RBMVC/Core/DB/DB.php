<?php 
namespace RBMVC\Core\DB;

use \PDO;

class DB {
    
    /**
     * @var \PDO 
     */
    private $db;
    
    /**
     * @var Query
     */
    private $query;
    
    /**
     * @var DB
     */
    private static $instance = null;
    
    /**
     * @return DB
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    /**
     * @param array $options
     * @return void
     */
    public function setup(array $options) {
        $user = array_key_exists('user', $options) ? $options['user'] : '';
        $host = array_key_exists('host', $options) ? $options['host'] : '';
        $name = array_key_exists('name', $options) ? $options['name'] : '';
        $pass = array_key_exists('user', $options) ? $options['pass'] : '';
        $driver = array_key_exists('driver', $options) ? $options['driver'] : '';
        $pdoOptions = array_key_exists('options', $options) ? $options['options'] : array();
        
        $dsn = $driver . ':host=' . $host . ';dbname=' . $name;
        $this->db = new PDO($dsn, $user, $pass, $pdoOptions);
        
        $this->query = new Query();
    }
    
    /**
     * @param \RBMVC\Core\DB\Query $query
     * @return void
     */
    public function setQuery(Query $query) {
        $this->query = $query;
    }
    
    /**
     * @param string $dbTable
     * @return \RBMVC\Core\DB\Query
     */
    public function getQuery($dbTable) {
        $this->query->setDBTable($dbTable);
        return $this->query;
    }
    
    /**
     * @param \RBMVC\Core\DB\Query $query
     * @return boolean|\PDOStatement
     */
    public function execute(Query &$query) {
        try {
            /** @var \PDOStatement $stmt */
            $stmt = $this->db->prepare($query->getSQL());
            if (!$stmt->execute($query->getParams())) {
                error_log(__METHOD__.'::> ###########################################################################');
                error_log(__METHOD__.'::> '.print_r($stmt->errorInfo(), 1));
                error_log(__METHOD__.'::> '.print_r($query, 1));
                error_log(__METHOD__.'::> ###########################################################################');
            }

            $query->reset();
            return $stmt;
        } catch (\PDOException $e) {
            error_log(__METHOD__.'::> '.$e->getMessage());
            return false;
        }
    }
    
    /**
     * @return string
     */
    public function lastInsertId() {
        return (int) $this->db->lastInsertId();
    }
}