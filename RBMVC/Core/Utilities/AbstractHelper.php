<?php
namespace RBMVC\Core\Utilities;

use RBMVC\Core\View\View;
use RBMVC\Core\Request;

abstract class AbstractHelper {
        
    /**
     * @var \RBMVC\Core\Request
     */
    protected $request;
    
    /**
     * @var \RBMVC\Core\View\View
     */
    protected $view;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param \RBMVC\Core\Request $request
     * @return \RBMVC\Core\View\Helper\AbstractHelper
     */
    public function setRequest(Request $request) {
        $this->request = $request;
        return $this;
    }
    
    /**
     * @param \RBMVC\Core\View\View $view
     * @return \RBMVC\Core\View\Helper\AbstractHelper
     */
    public function setView(View &$view) {
        $this->view = $view;
        return $this;
    }

    /**
     * @param array $config
     * @return \RBMVC\Core\View\Helper\AbstractHelper
     */
    public function setConfig(array $config) {
        $this->config = $config;
        return $this;
    }
    
}