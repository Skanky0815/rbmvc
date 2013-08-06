<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 15:54
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Exception;


class ClassLoadingException extends \Exception {

    public function __construct($message = "", $code = 0, \Exception $previous = null) {
        parent::__construct($message, $code, $previous);

        error_log(__CLASS__.'::> '.print_r($message, 1));
    }
}