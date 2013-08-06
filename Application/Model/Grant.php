<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 00:11
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Model;

use RBMVC\Core\Model\AbstractModel;

class Grant extends AbstractModel {

    const TYPE_PUBLIC = 1;

    const TYPE_PROTECTED = 2;

    const TYPE_PRIVATE = 3;

    /**
     * @var string
     */
    private $definition;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $isActive;

    /**
     * @param string $definition
     *
     * @return \Application\Model\Grant
     */
    public function setDefinition($definition) {
        $this->definition = $definition;

        return $this;
    }

    /**
     * @return string
     */
    public function getDefinition() {
        return $this->definition;
    }

    /**
     * @param string $description
     *
     * @return \Application\Model\Grant
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
     * @param int $type
     *
     * @return \Application\Model\Grant
     */
    public function setType($type) {
        $this->type = (int) $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param boolean $isAction
     *
     * @return \Application\Model\Grant
     */
    public function setIsActive($isAction) {
        $this->isActive = $isAction;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsActive() {
        return (bool) $this->isActive;
    }

    /**
     * @return bool
     */
    public function isActive() {
        return (bool) $this->isActive;
    }

}