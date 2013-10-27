<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 22:54
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\Checkbox;

/**
 * Class CheckboxElement
 * @package RBMVC\Core\Utilities\Form\Elements
 */
class CheckboxElement extends AbstractElement {

    /**
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name, new Checkbox());
    }

}