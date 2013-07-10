<?php
namespace RBMVC\Core\Controller;

use RBMVC\Core\Utilities\AbstractHelperFactory;
use RBMVC\Core\Controller\Helper\AbstractActionHelper;

class ActionHelperFactory extends AbstractHelperFactory {

    protected function loadHelper($name) {
        $className = '\RBMVC\Core\Controller\Helper\\' . ucfirst($name);
        $helper = new $className;
        if ($helper instanceof AbstractActionHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $this->helper[$name] = $helper;
            return $helper;
        }
    }

}