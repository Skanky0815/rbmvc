<?php
namespace RBMVC\Core\Utilities\Modifiers\String;

class CamelCaseToUnderscore {

    /**
     * @param string $str
     * @return string
     */
    public function convert($str) {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2',  $str));
    }
}
