<?php
namespace RBMVC\Core\View\Helper;

class Navigation extends HasAccess {

    /**
     * @var array
     */
    private $navigation;

    private $controller;

    private $action;

    public function init() {
        $this->navigation = include_once(APPLICATION_DIR . 'data/config/navigation.php');
        $this->action     = $this->request->getParam('action');
        $this->controller = $this->request->getParam('controller');
    }

    public function navigation($root, $level = 0) {
        $this->init();

        $navigation = $this->modifyNavigation($this->navigation[$root]);

        return $this->view->partial('layout/partials/nav.phtml', array('navigation' => $navigation));
    }

    private function modifyNavigation(&$navigation) {
        foreach ($navigation as $key => &$navigationPoint) {
            $navigationPoint['is_active'] = false;
            if ($navigationPoint['controller'] == $this->controller) {
                $navigationPoint['is_active'] = true;
            }

            if (isset($navigationPoint['pages']) && !empty($navigationPoint['pages'])) {
                $navigationPoint['pages'] = $this->modifyNavigation($navigationPoint['pages']);
            }

            if (!$this->hasAccess($navigationPoint)) {
                unset($navigation[$key]);
            }
        }

        return $navigation;
    }
}
