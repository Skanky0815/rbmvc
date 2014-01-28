<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 09:15
 */

namespace Application\Lib\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class Text
 * @package Application\Lib\Model
 */
abstract class Text extends AbstractModel {

    /**
     * @var
     */
    private $languageId;

    /**
     * @param mixed $language
     *
     * @return Text
     */
    public function setLanguageId($language) {
        $this->languageId = $language;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguageId() {
        return $this->languageId;
    }

}