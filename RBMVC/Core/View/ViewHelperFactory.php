<?php
namespace RBMVC\Core\View;

use RBMVC\Core\Utilities\AbstractHelperFactory;
use RBMVC\Core\View\Helper\AbstractViewHelper;

class ViewHelperFactory extends AbstractHelperFactory {

    protected function loadHelper($name) {
        $className = ucfirst($name);
        $helper = $this->classLoader->getClassInstance($className);
        if ($helper instanceof AbstractViewHelper) {
            $helper->setView($this->view);
            $helper->setRequest($this->request);
            $helper->setConfig($this->config);
            $this->helper[$name] = $helper;
            return $helper;
        }
    }

}