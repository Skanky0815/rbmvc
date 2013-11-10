<?php
namespace RBMVC\Core\View;

use RBMVC\Core\Utilities\AbstractHelperFactory;
use RBMVC\Core\View\Helper\AbstractViewHelper;

/**
 * Class ViewHelperFactory
 * @package RBMVC\Core\View
 */
class ViewHelperFactory extends AbstractHelperFactory {

    /**
     * @param string $name
     *
     * @return null|AbstractViewHelper
     */
    protected function loadHelper($name) {
        $className = ucfirst($name);
        $helper    = $this->classLoader->getClassInstance($className);
        if ($helper instanceof AbstractViewHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $helper->setConfig($this->config);
            $this->helpers[$name] = $helper;

            return $helper;
        }

        return null;
    }

}