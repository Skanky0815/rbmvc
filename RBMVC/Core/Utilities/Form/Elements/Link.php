<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.10.13
 * Time: 10:16
 */

namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\SingleLink;

/**
 * Class SingleLink
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class Link extends AbstractElement {

    /**
     * _blank
     */
    const TARGET_BLANK = '_blank';

    /**
     * _self
     */
    const TARGET_SELF = '_self';

    /**
     * default button
     */
    const LAYOUT_DEFAULT = 'btn-default';

    /**
     * link button
     */
    const LAYOUT_LINK = 'btn-link';

    /**
     * @var string
     */
    private $target = self::TARGET_BLANK;

    /**
     * @var string
     */
    private $url = '';

    /**
     * @var string
     */
    private $type = '';

    /**
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name, new SingleLink());
    }

    /**
     * @param boolean $hasError
     *
     * @return AbstractElement
     */
    public function setHasError($hasError) {
        $this->hasError = $hasError;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getHasError() {
        return $this->hasError;
    }

    /**
     * @param string $target
     *
     * @return Link
     */
    public function setTarget($target) {
        $this->target = $target;

        return $this;
    }

    /**
     * @return string
     */
    public function getTarget() {
        return $this->target;
    }

    /**
     * @param array $url
     *
     * @return Link
     */
    public function setUrl($url) {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $type
     *
     * @return Link
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
