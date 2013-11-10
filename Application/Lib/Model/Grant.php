<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:11
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class Grant
 * @package Application\Lib\Model
 */
class Grant extends AbstractModel {

    /**
     * public
     */
    const TYPE_PUBLIC = 1;

    /**
     * protected
     */
    const TYPE_PROTECTED = 2;

    /**
     * private
     */
    const TYPE_PRIVATE = 3;

    /**
     * @var string
     */
    private $definition = '';

    /**
     * @var int
     */
    private $type = 0;

    /**
     * @var string
     */
    private $description = '';

    /**
     * @var bool
     */
    private $isActive = false;

    /**
     * @return string
     */
    public function getDefinition() {
        return $this->definition;
    }

    /**
     * @param string $definition
     *
     * @return Grant
     */
    public function setDefinition($definition) {
        $this->definition = $definition;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return Grant
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive() {
        return (bool) $this->isActive;
    }

    /**
     * @param boolean $isAction
     *
     * @return Grant
     */
    public function setIsActive($isAction) {
        $this->isActive = $isAction;

        return $this;
    }

    /**
     * @return int
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return Grant
     */
    public function setType($type) {
        $this->type = (int) $type;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return (bool) $this->isActive;
    }

}