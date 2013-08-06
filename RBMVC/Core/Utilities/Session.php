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
     * @param string|array|object $values
     *
     * @return \RBMVC\Core\Utilities\Session
     */
    public function __set($name, $values) {
        $var = null;
        if (is_array($values)) {
            $var = array();
            foreach ($values as $value) {
                $var[] = $this->serialize($value);
            }
        } else {
            $var = $this->serialize($values);
        }

        $_SESSION[$this->namespace][$name] = $var;

        return $this;
    }

    private function serialize($value) {
        if (is_object($value)) {
            $value = array(
                'value'     => serialize($value),
                'is_object' => true
            );
        }

        return $value;
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    public function __get($name) {
        if (!array_key_exists($this->namespace, $_SESSION) || !array_key_exists($name, $_SESSION[$this->namespace])) {
            return null;
        }

        $var    = null;
        $values = $_SESSION[$this->namespace][$name];
        if (is_array($values) && !array_key_exists('value', $values)) {
            $var = array();
            foreach ($values as $value) {
                $var[] = $this->unserialize($value);
            }
        } else {
            $var = $this->unserialize($values);
        }

        return $var;
    }

    private function unserialize($value) {
        if (isset($value['is_object'])) {
            $value = unserialize($value['value']);
        }

        return $value;
    }

    /**
     * @return string
     */
    public function getNamespace() {
        return $this->namespace;
    }

    /**
     * @param string $namespace
     *
     * @return void
     */
    public function resetNamespace($namespace = '') {
        $namespace = empty($namespace) ? $this->namespace : $namespace;
        unset($_SESSION[$namespace]);
    }

}