<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 11:02
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Modifiers\String;

/**
 * Class CamelCaseToDash
 * @package RBMVC\Core\Utilities\Modifiers\String
 */
class CamelCaseToDash {

    /**
     * @param string $str
     *
     * @return string
     */
    public function convert($str) {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $str));
    }
}