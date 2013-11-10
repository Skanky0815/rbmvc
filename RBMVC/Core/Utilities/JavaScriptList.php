<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 02.11.13
 * Time: 03:36
 */

namespace RBMVC\Core\Utilities;

    /**
     * Class JavaScriptList
     * @package RBMVC\Core\Utilities
     */
/**
 * Class JavaScriptList
 * @package RBMVC\Core\Utilities
 */
class JavaScriptList {

    /**
     * @var null
     */
    private static $instance = null;

    /**
     * @var array
     */
    private $list = array();

    /**
     * @param $path
     *
     * @return void
     */
    public function addToList($path) {
        if (!in_array($path, $this->list)) {
            $this->list[] = $path;
        }
    }

    /**
     * @return null|JavaScriptList
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new JavaScriptList();
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    public function getList() {
        return $this->list;
    }

    /**
     * @param array $list
     *
     * @return JavaScriptList
     */
    public function setList($list) {
        $this->list = $list;

        return $this;
    }

}