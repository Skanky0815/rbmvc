<?php 
namespace RBMVC\Core\View;

use RBMVC\Core\View\ViewHelperFactory;

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
     * @var boolean 
     */
    private $doRender = true;
    
    /**
     * @var boolean
     */
    private $doLayout = true;
    
    /**
     * @var ViewHelperFactory
     */
    private $viewHelperFactory;
    
    /**
     * @param \RBMVC\Core\View\ViewHelperFactory $viewHelperFactory
     * @return View
     */
    public function setViewHelperFactory(ViewHelperFactory $viewHelperFactory) {
        $this->viewHelperFactory = $viewHelperFactory;
        return $this;
    }
    
    /**
     * @return ViewHelperFactory
     */
    public function getViewHelperFactory() {
        return $this->viewHelperFactory;
    }
    
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
    
    /*
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
        
        if (file_exists(APPLICATION_DIR . $path)) {
            ob_start();
            include $path;
            $template = ob_get_contents();
            ob_end_clean();       
        } else {
            $template = 'No template file was found in the path: ' . $path;
        }
        
        return $template;
    }
    
    /**
     * @return void
     */
    private function loadLayoutTemplate() {
        $path = 'template/layout/layout.phtml';
        include_once $path;
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
     * @return View
     */
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
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
     * @param string $name
     * @param array $args
     * @return mixed
     */
    public function __call($name, $args) {
        $name = strtolower($name);
        $helper = $this->viewHelperFactory->getHelper($name);
        
        return call_user_func_array(
            array($helper, $name),
            $args
        );
    }
}