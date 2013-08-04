<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 17:24
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\View\Helper;

class Button extends HasAccess {

    /**
     * @param array $options
     *
     * @return string
     */
    public function button(array $options) {
        if (!$this->hasAccess($options['url'])) {
            return '';
        }

        return $this->view->partial('layout/partials/button.phtml', $options);
    }
}