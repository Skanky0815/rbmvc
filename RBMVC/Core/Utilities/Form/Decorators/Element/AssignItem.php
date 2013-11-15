<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 12.11.13
 * Time: 09:49
 */

namespace RBMVC\Core\Utilities\Form\Decorators\Element;

/**
 * Class AssignItem
 * @package RBMVC\Core\Utilities\Form\Decorators\Element
 */
class AssignItem {

    /**
     * @var string
     */
    private $title = '';

    /**
     * @var string
     */
    private $value = '';

    /**
     * @param string $title
     *
     * @return AssignItem
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

    /**
     * @param string $value
     *
     * @return AssignItem
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

}