<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 10:04
 */

namespace Application\Lib\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class Language
 * @package Application\Lib\Model
 */
class Language extends AbstractModel {

    /**
     * @var string
     */
    private $code = '';

    /**
     * @param string $code
     *
     * @return Language
     */
    public function setCode($code) {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode() {
        return $this->code;
    }
}