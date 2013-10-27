<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 02.08.13
 * Time: 23:52
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Decorators\Element\HiddenInput;

class HiddenElement extends AbstractElement {

    public function __construct($name) {
        parent::__construct($name, new HiddenInput());
    }

}