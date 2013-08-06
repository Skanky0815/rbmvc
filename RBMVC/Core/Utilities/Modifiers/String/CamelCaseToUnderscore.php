<?php
namespace RBMVC\Core\Utilities\Modifiers\String;

class CamelCaseToUnderscore {

    /**
     * @param string $str
     *
     * @return string
     */
    public function convert($str) {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1_', $str));
    }
}
