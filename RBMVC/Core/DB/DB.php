<?php 
namespace RBMVC\Core\DB;

class DB {
    
    /**
     * @var \PDO 
     */
    private $db;

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
        $user = key_exists('user', $options) ? $options['user'] : '';
        $host = key_exists('host', $options) ? $options['host'] : '';
        $name = key_exists('name', $options) ? $options['name'] : '';
        $pass = key_exists('user', $options) ? $options['pass'] : '';
        $driver = key_exists('driver', $options) ? $options['driver'] : '';
        $pdoOptions = key_exists('options', $options) ? $options['options'] : array();
        
        $dsn = $driver . ':host=' . $host . ';dbname=' . $name;
        $this->db = new \PDO($dsn, $user, $pass, $pdoOptions);
    }
    
    /**
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, array $args) {
        $callback = array($this->db, $name);
        return call_user_func_array($callback, $args);
    }
}