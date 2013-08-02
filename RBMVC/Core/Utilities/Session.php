<?php
namespace RBMVC\Core\Utilities;

class Session {
    
    /**
     * @var string
     */
    private $namespace;
    
    /**
     * @param string $namespace
     */
    public function __construct($namespace) {
        $this->namespace = $namespace;
    }
    
    /**
     * @return void 
     */
    public static function start() {
        session_start();
    }
    
    /**
     * @param string $name
     * @param string $value
     * @return \RBMVC\Core\Utilities\Session
     */
    public function __set($name, $value) {
        $_SESSION[$this->namespace][$name] = $value;
        return $this;
    }
    
    /**
     * @param string $name
     * @return mixed|null
     */
    public function __get($name) {
        if (array_key_exists($this->namespace, $_SESSION) && array_key_exists($name, $_SESSION[$this->namespace])) {
            return $_SESSION[$this->namespace][$name];
        }
        
        return null;
    }
    
    /**
     * @return string
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     * @return void
     */
    public function resetNamespace($namespace = '') {
        $namespace = empty($namespace) ? $this->namespace : $namespace;
        unset($_SESSION[$namespace]);
    }
    
}