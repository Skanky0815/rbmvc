<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 09:18
 */

namespace Application\Lib\Model;

/**
 * Class BaseText
 * @package Application\Lib\Model
 */
class BaseText extends Text {

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $description = '';

    /**
     * @param string $description
     *
     * @return BaseText
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $title
     *
     * @return BaseText
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

} 