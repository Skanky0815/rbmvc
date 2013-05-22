<?php

namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Request;
use RBMVC\Core\View\View;

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
     * @return void
     */
    public function setRequest(Request $request) {
        $this->request = $request;
    }
    
    /**
     * @param \RBMVC\Core\View\View $view
     * @return void
     */
    public function setView(View $view) {
        $this->view = $view;
    }
}
