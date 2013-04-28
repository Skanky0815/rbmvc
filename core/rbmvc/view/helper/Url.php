<?php
namespace core\rbmvc\view\helper;

use core\rbmvc\view\helper\AbstractHelper;

class Url extends AbstractHelper {
    
    private $useParams;
    
    public function url(array $options = array(), $useParams = false) {
        $this->useParams = $useParams;
        $urlParams = array_merge($this->request->getGetParams(), $options);
        return $this->renderUrl($urlParams);
    }
    
    private function renderUrl(array $urlParams) {
        $url =  '/'
            . $urlParams['controller']
            . '/'
            . $urlParams['action'];
        
        unset($urlParams['controller']);
        unset($urlParams['action']);
        
        if (empty($urlParams) || !$this->useParams) {
            return $url;
        }  
        
        $url .= '?';
        foreach ($urlParams as $key => $value) {
            $url .= $key . '=' . $value . '&';
        }
        
        return $url;
    }
}