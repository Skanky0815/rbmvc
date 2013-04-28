<?php
namespace core\rbmvc;

use core\rbmvc\View;
use core\rbmvc\Request;

abstract class AbstractController {
    
    protected $request;
    
    protected $view;
    
    public function init() {
        
    }
    
    public function indexAction() {
        
    }
    
    public function setRequest(Request $request) {
        $this->request = $request;
    }
    
    public function getRequest() {
        return $this->request;
    }
    
    public function getView() {
        return $this->view;
    }
    
    public function setView(View &$view) {
        $this->view = $view;
    }
}

