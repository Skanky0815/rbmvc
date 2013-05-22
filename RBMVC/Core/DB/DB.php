<?php 
namespace RBMVC\Core\DB;

class DB {
    
    private $user;
    
    private $host;
    
    private $name;
    
    private $pass;
    
    private static $instance = null;
    
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
    }
    
    public function setup(array $options) {
        $this->user = key_exists('user', $options) ? $options['user'] : '';
        $this->host = key_exists('host', $options) ? $options['host'] : '';
        $this->name = key_exists('name', $options) ? $options['name'] : '';
        $this->pass = key_exists('user', $options) ? $options['pass'] : '';
    }
    
    private function connect() {
        mysql_connect($this->host, $this->user, $this->pass) or die(mysql_error());
        mysql_select_db($this->name);
    }
    
    public function query($query) {
        $this->connect();
        $result = mysql_query($query);
        mysql_close();
        return $result;
    }
    
    public function fetch($query) {
        $result = $this->query($query);
        $entries = array();
        while ($row = mysql_fetch_array($result)) {
            $entries[] = $row;
        }
        return count($entries) > 1 ? $entries : reset($entries);
    }
}