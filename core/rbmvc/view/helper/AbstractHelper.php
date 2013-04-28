<?php

namespace core\rbmvc\view\helper;

use core\rbmvc\View;
use core\rbmvc\Request;

abstract class AbstractHelper {
    
    protected $request;
    
    protected $view;

    public function __construct(Request $request, View $view) {
        $this->request = $request;
        $this->view = $view;
    }
}
