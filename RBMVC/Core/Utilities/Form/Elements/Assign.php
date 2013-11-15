<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 10.11.13
 * Time: 20:30
 */

namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\Assign as AssignDecorator;
use RBMVC\Core\Utilities\Form\Decorators\Element\AssignItem;

/**
 * Class Assign
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class Assign extends AbstractElement {

    /**
     * @var AssignItem[]
     */
    private $assigned = array();

    /**
     * @var AssignItem[]
     */
    private $unAssigned = array();

    public function __construct($name) {
        parent::__construct($name, new AssignDecorator());
    }

    /**
     * @param AssignItem[] $assigned
     *
     * @return Assign
     */
    public function setAssigned($assigned) {
        $this->assigned = $assigned;

        return $this;
    }

    /**
     * @return AssignItem[]
     */
    public function getAssigned() {
        return $this->assigned;
    }

    /**
     * @param AssignItem[] $unAssigned
     *
     * @return Assign
     */
    public function setUnAssigned($unAssigned) {
        $this->unAssigned = $unAssigned;

        return $this;
    }

    /**
     * @return AssignItem[]
     */
    public function getUnAssigned() {
        return $this->unAssigned;
    }

}