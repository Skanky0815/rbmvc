<?php 
namespace core\rbmvc\db;

class DB {
    
    private $user = 'root';
    
    private $host = 'localhost';
    
    private $name = 'basti_test';
    
    private $pass = 'root';
    
    private static $instance = null;
    
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new DB();
        }
        return self::$instance;
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