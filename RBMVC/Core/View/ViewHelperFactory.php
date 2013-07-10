<?php
namespace RBMVC\Core\View;

use RBMVC\Core\Utilities\AbstractHelperFactory;
use RBMVC\Core\View\Helper\AbstractViewHelper;

class ViewHelperFactory extends AbstractHelperFactory {

    protected function loadHelper($name) {
        $className = '\RBMVC\Core\View\Helper\\' . ucfirst($name);
        $helper = new $className;
        if ($helper instanceof AbstractViewHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $this->helper[$name] = $helper;
            return $helper;
        }
    }

}