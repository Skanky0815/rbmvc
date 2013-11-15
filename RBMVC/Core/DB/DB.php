<?php
namespace RBMVC\Core\DB;

use PDO;

/**
 * Class DB
 * @package RBMVC\Core\DB
 */
class DB {

    /**
     * @var DB
     */
    private static $instance = null;

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @var Query
     */
    private $query;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $pass;

    /**
     * @var string
     */
    private $driver;

    /**
     * @var array
     */
    private $pdoOptions;

    /**
     * @return array
     */
    public function __sleep() {
        return array('query', 'user', 'host', 'pass', 'driver', 'pdoOptions');
    }

    /**
     *
     */
    public function __wakeup() {
        $this->connect();
    }

    /**
     * @param Query $query
     *
     * @return boolean|\PDOStatement
     */
    public function execute(Query &$query) {
        try {
            /** @var \PDOStatement $stmt */
            $stmt = $this->db->prepare($query->getSQL());
            if (!$stmt->execute($query->getParams())) {
                error_log(__METHOD__ . '::> ###########################################################################');
                error_log(__METHOD__ . '::> ' . print_r($stmt->errorInfo(), 1));
                error_log(__METHOD__ . '::> ' . print_r($query, 1));
                error_log(__METHOD__ . '::> ###########################################################################');
            }

            return $stmt;
        } catch (\PDOException $e) {
            error_log(__METHOD__ . '::> ' . $e->getMessage());

            return false;
        }
    }

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
     * @param string $dbTable
     *
     * @return Query
     */
    public function getQuery($dbTable) {
        $query = new Query();
        $query->setDBTable($dbTable);

        return $query;
    }

    /**
     * @param Query $query
     *
     * @return void
     */
    public function setQuery(Query $query) {
        $this->query = $query;
    }

    /**
     * @return string
     */
    public function lastInsertId() {
        return (int) $this->db->lastInsertId();
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function setup(array $options) {
        $this->user       = array_key_exists('user', $options) ? $options['user'] : '';
        $this->host       = array_key_exists('host', $options) ? $options['host'] : '';
        $this->name       = array_key_exists('name', $options) ? $options['name'] : '';
        $this->pass       = array_key_exists('pass', $options) ? $options['pass'] : '';
        $this->driver     = array_key_exists('driver', $options) ? $options['driver'] : '';
        $this->pdoOptions = array_key_exists('options', $options) ? $options['options'] : array();

        $this->connect();
    }

    /**
     *
     */
    private function connect() {
        $dsn      = $this->driver . ':host=' . $this->host . ';dbname=' . $this->name;
        $this->db = new PDO($dsn, $this->user, $this->pass, $this->pdoOptions);
    }
}