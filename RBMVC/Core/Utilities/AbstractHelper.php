<?php
namespace RBMVC\Core\Utilities;

use RBMVC\Core\View\View;
use RBMVC\Core\Request;

abstract class AbstractHelper {
        
    /**
     * @var Request 
     */
    protected $request;
    
    /**
     * @var View 
     */
    protected $view;

    
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
    
}