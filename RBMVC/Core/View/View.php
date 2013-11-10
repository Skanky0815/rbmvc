<?php
namespace RBMVC\Core\View;

use RBMVC\Core\View\Helper\AbstractViewHelper;

/**
 * Class View
 * @package RBMVC\Core\View
 */
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
    protected $jsAppPath = '/js/app/';

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
     * @var array
     */
    private $variables = array();

    /**
     * @param string $name
     * @param array $args
     *
     * @return mixed
     */
    public function __call($name, $args) {
        return $this->viewHelperFactory->callFunction($name, $args);
    }

    /**
     * @param string $name
     *
     * @return null|mixed
     */
    public function __get($name) {
        if (array_key_exists($name, $this->variables)) {
            return $this->variables[$name];
        }

        return null;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return View;
     */
    public function __set($name, $value) {
        $this->variables[$name] = $value;

        return $this;
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    public function addStyle($fileName) {
        $url = '/css/' . $fileName;

        return '<link href="' . $url . '" rel="stylesheet"/>';
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function assign($name, $value) {
        $this->__set($name, $value);
    }

    /**
     * @return void
     */
    public function clearVars() {
        $this->variables = array();
    }

    /**
     * @return void
     */
    public function disableLayout() {
        $this->doLayout = false;
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
    public function enableRender() {
        $this->doRender = true;
    }

    /**
     * @param string $name
     *
     * @return AbstractViewHelper
     */
    public function getViewHelper($name) {
        $name = strtolower($name);

        return $this->viewHelperFactory->getHelpers($name);
    }

    /**
     * @return ViewHelperFactory
     */
    public function getViewHelperFactory() {
        return $this->viewHelperFactory;
    }

    /**
     * @param ViewHelperFactory $viewHelperFactory
     *
     * @return View
     */
    public function setViewHelperFactory(ViewHelperFactory $viewHelperFactory) {
        $this->viewHelperFactory = $viewHelperFactory;

        return $this;
    }

    /**
     * @param string $fileName
     * @param array $variables
     *
     * @return mixed
     */
    public function partial($fileName, array $variables = array()) {
        $view = clone $this;
        $view->enableRender();
        $view->variables = $variables;

        return $view->render('template/' . $fileName);
    }

    /**
     * @param string $path
     *
     * @return string|void
     */
    public function render($path = '') {
        if (!$this->doRender) {
            return '';
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
     * @param array $params
     *
     * @return View
     */
    public function setParams(array $params) {
        $this->params = $params;

        return $this;
    }

    /**
     * @return string
     */
    private function loadLayoutTemplate() {
        return include_once ROOT_DIR . 'template/layout/layout.phtml';
    }

    /**
     * @param string $includePath
     *
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

        if (file_exists(ROOT_DIR . $path)) {
            ob_start();
            include $path;
            $template = ob_get_contents();
            ob_end_clean();
        } else {
            $template = 'No template file was found in the path: <i>' . $path . '</i>';
        }

        return $template;
    }

}