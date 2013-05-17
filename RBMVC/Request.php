<?php
namespace RBMVC;

class Request {
    
    /**
     * @var array 
     */
    private $params;
    
    /**
     * @var array 
     */
    private $getParams;
    
    /**
     * @var array
     */
    private $postParams;
    
    /**
     * @return void
     */
    public function __construct() {
        $this->getParams = $_GET;
        $this->postParams = $_POST;
        
        $this->includeRoutingParams();
        $this->params = array_merge($this->getParams, $this->postParams);
    }
    
    /**
     * @return array
     */
    public function getGetParams() {
        return $this->getParams;
    }
    
    /**
     * @param string $index
     * @param mixed $default
     * @return string
     */
    public function getParam($index, $default = '') {
        return isset($this->params[$index]) ? $this->params[$index] : $default;
    }
    
    /**
     * @return array
     */
    public function getPostParams() {
        return $this->postParams;
    }
    
    /**
     * @return array
     */
    public function getParams() {
        return $this->params;
    }
    
    /**
     * @return boolean
     */
    public function isPost() {
        return (boolean) !empty($this->postParams);
    }
    
    /**
     * @return void
     */
    private function includeRoutingParams() {
        $url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : '';
        $request = explode('/', $url);
        $params = 
                array('controller'  => !empty($request[1]) ? $request[1] : 'index'
                    , 'action'      => !empty($request[2]) ? $request[2] : 'index'
        );
        $this->getParams = array_merge($this->getParams, $params);
    }
}