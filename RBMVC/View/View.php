<?php 
namespace RBMVC\View;

use RBMVC\View\Helper\AbstractHelper;

class View {
    
    /**
     * @var string 
     */
    private static $TEMPLATE_PATH = 'template/views/%s/%s.phtml';
    
    /**
     * @var array
     */
    public $params;
    
    /**
     * @var string 
     */
    private $content;
    
    /**
     * @var array 
     */
    private $helpers;
    
    /**
     * @var boolean 
     */
    private $doRender = true;
    
    /**
     * @var boolean
     */
    private $doLayout = true;
    
    /**
     * @param string $path
     * @return string
     */
    public function render($path = '') {
        if (!$this->doRender) {
            return;
        }
        
        $template = $this->loadTemplate($path);
        if (!$this->doLayout || !empty($path)) {
            return $template;
        } else {
            $this->content = $template;
        }
        
        return $this->loadLayoutTemplate();
    }
    
    /**
     * @return void
     */
    public function disableRender() {
        $this->doRender = false;
    }
    
    /**
     * @return void
     */
    public function disableLayout() {
        $this->doLayout = false;
    }
    
    /**
     * @return string
     */
    private function loadTemplate($includePath) {
        if (empty($includePath)) {
            $path = sprintf(self::$TEMPLATE_PATH
                        , $this->params['controller']
                        , $this->params['action']
            );
        } else {
            $path = $includePath;
        }
        ob_start();
        include $path;
        $template = ob_get_contents();
        ob_end_clean();
        
        return $template;
    }
    
    /**
     * @return void
     */
    private function loadLayoutTemplate() {
        $dir = 'template/layout/layout.phtml';
        include_once $dir;
    }
    
    /**
     * @param string $fileName
     * @return string
     */
    public function partial($fileName) {
        return $this->render('template/layout/partials/' . $fileName);
    }
    
    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params) {
        $this->params = $params;
    }
    
    /**
     * @param string $fileName
     * @return string
     */
    public function addStyle($fileName) {
        $url = '/css/' . $fileName;
        return '<link href="' . $url . '" rel="stylesheet"/>';
    }
    
    /**
     * @param \RBMVC\View\Helper\AbstractHelper $helper
     * @return void
     */
    public function addHelper(AbstractHelper $helper) {
        $helperName = get_class($helper);
        $helperName = strtolower($helperName);
        $helperNameParts = explode('\\', $helperName);
        $className = end($helperNameParts);
        $index = strtolower($className);
        $this->helpers[$index] = $helper;
    }
    
    /**
     * @param string $name
     * @param string $args
     * @return mixed
     */
    public function __call($name, $args) {
        $name = strtolower($name);
        $helper = $this->helpers[$name];
        
        return call_user_func_array(
            array($helper, $name),
            $args
        );
    }
}