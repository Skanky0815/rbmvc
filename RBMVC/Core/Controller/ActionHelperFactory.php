<?php
namespace RBMVC\Core\Controller;

use RBMVC\Core\Controller\Helper\AbstractActionHelper;
use RBMVC\Core\Utilities\AbstractHelperFactory;

class ActionHelperFactory extends AbstractHelperFactory {

    protected function loadHelper($name) {
        $className = ucfirst($name);
        $helper    = $this->classLoader->getClassInstance($className);
        if ($helper instanceof AbstractActionHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $helper->setConfig($this->config);
            $this->helper[$name] = $helper;

            return $helper;
        }

        return null;
    }

}