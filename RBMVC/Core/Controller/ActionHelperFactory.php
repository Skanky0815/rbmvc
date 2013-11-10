<?php
namespace RBMVC\Core\Controller;

use RBMVC\Core\Controller\Helper\AbstractActionHelper;
use RBMVC\Core\Utilities\AbstractHelperFactory;

/**
 * Class ActionHelperFactory
 * @package RBMVC\Core\Controller
 */
class ActionHelperFactory extends AbstractHelperFactory {

    /**
     * @param string $name
     *
     * @return AbstractActionHelper|null
     */
    protected function loadHelper($name) {
        $className = ucfirst($name);
        $helper    = $this->classLoader->getClassInstance($className);
        if ($helper instanceof AbstractActionHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $helper->setConfig($this->config);
            $this->helpers[$name] = $helper;

            return $helper;
        }

        return null;
    }

}