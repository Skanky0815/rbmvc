<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 09:14
 */

namespace Application\Lib\Model;

use RBMVC\Core\Model\AbstractModel;

/**
 * Class Media
 * @package Application\Lib\Model
 */
class Media extends AbstractModel {

    /**
     * @var string
     */
    private $name = '';

    /**
     * @var string
     */
    private $type = '';

    /**
     * @var string
     */
    private $path = '';

    /** @var BaseText */
    private $text = null;

    /**
     * @param string $name
     *
     * @return Media
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $path
     *
     * @return Media
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param \Application\Lib\Model\BaseText $text
     *
     * @return Media
     */
    public function setText($text) {
        $this->text = $text;

        return $this;
    }

    /**
     * @return \Application\Lib\Model\BaseText
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $type
     *
     * @return Media
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

}