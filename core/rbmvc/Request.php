<?php
namespace core\rbmvc;

class Request {
    
    private $params;
    
    private $getParams;
    
    private $postParams;
    
    public function __construct() {
        $this->getParams = $_GET;
        $this->postParams = $_POST;
        
        $this->params = array_merge($this->getParams, $this->postParams);
    }
    
    public function addGetParams(array $params) {
        $this->getParams = array_merge($this->getParams, $params);
        $this->params = array_merge($this->getParams, $this->postParams);
    } 
    
    public function getGetParams() {
        return $this->getParams;
    }
    
    public function getParam($index, $default = '') {
        return isset($this->params[$index]) ? $this->params[$index] : $default;
    }
    
    public function getPostParams() {
        return $this->postParams;
    }
    
    public function getParams() {
        return $this->params;
    }
    
    public function isPost() {
        return !empty($this->postParams);
    }
    
}