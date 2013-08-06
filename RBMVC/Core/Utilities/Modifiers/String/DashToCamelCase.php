<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:13
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Modifiers\String;

class DashToCamelCase {

    /**
     * @param string $str
     *
     * @return string
     */
    public function convert($str) {
        return preg_replace('/\-(.)/e', "strtoupper('\\1')", $str);
    }
}