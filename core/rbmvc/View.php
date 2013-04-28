<?php 
namespace core\rbmvc;

use core\rbmvc\view\helper\AbstractHelper;

class View {
    
    private static $TEMPLATE_PATH = 'template/views/%s/%s.phtml';
    
    public $params;
    
    private $helpers;
    
    private $doRender = true;
    
    private $doLayout = true;
    
    public function render($path = '') {
        if (!$this->doRender) {
            return;
        }
        
        $this->loadTemplate($path);
        if (!$this->doLayout) {
            return $this->content;
        }
        
        return $this->loadLayoutTemplate();
    }
    
    public function disableRender() {
        $this->doRender = false;
    }
    
    public function disableLayout() {
        $this->doLayout = false;
    }
    
    private function loadTemplate($path) {
        ob_start();
        if (empty($path)) {
            $path = sprintf(self::$TEMPLATE_PATH
                        , $this->params['controller']
                        , $this->params['action']
            );
        }
        include $path;
        $this->content = ob_get_contents();
        ob_end_clean();
    }
    
    private function loadLayoutTemplate() {
        $dir = 'template/layout/layout.phtml';
        include_once $dir;
    }
    
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
    
    public function addHelper(AbstractHelper $helper) {
        $helperName = get_class($helper);
        $helperName = strtolower($helperName);
        $helperNameParts = explode('\\', $helperName);
        $className = end($helperNameParts);
        $index = strtolower($className);
        $this->helpers[$index] = $helper;
    }
    
    public function __call($name, $args) {
        $name = strtolower($name);
        $helper = $this->helpers[$name];
        
        return call_user_func_array(
            array($helper, $name),
            $args
        );
    }
}