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

    /**
     * @var string
     */
    private $description = '';

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
        if (empty($this->name)) {
            $this->name = $this->loadTexts('name');
        }

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
     * @param string $description
     *
     * @return Media
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription() {
        if (empty($this->description)) {
            $this->description = $this->loadTexts('description');
        }

        return $this->description;
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