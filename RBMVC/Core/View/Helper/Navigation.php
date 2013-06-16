<?php
namespace RBMVC\Core\View\Helper;

class Navigation extends AbstractHelper {
    
    public function navigation($root, $level = 0) {
        $navigation = include APPLICATION_DIR . 'data/config/navigation.php';
        
        $action = $this->request->getParam('action');
        $controller = $this->request->getParam('controller');
        
        foreach ($navigation[$root] as &$naviPoint) {
            $naviPoint['is_active'] = false;
            if ($naviPoint['controller'] == $controller) {
                $naviPoint['is_active'] = true;
            } 
        }
        
        return $this->view->partial('layout/partials/nav.phtml', array('navigation' => $navigation[$root]));
    }
}
