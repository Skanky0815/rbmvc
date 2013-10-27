<?php
namespace RBMVC\Core\Controller\Helper;

use RBMVC\Core\Utilities\AbstractHelper;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\View\Helper\RenderSystemMessages;

/**
 * Class AbstractActionHelper
 * @package RBMVC\Core\Controller\Helper
 */
class AbstractActionHelper extends AbstractHelper {

    /**
     * @param \RBMVC\Core\Utilities\SystemMessage $systemMessage
     *
     * @return void
     */
    protected function addFlashSystemMessage(SystemMessage $systemMessage) {
        $session                 = new Session('system_message');
        $tmp                     = $session->systemMessages;
        $tmp[]                   = serialize($systemMessage);
        $session->systemMessages = $tmp;
    }

    /**
     * @param \RBMVC\Core\Utilities\SystemMessage $systemMessage
     */
    protected function addSystemMessage(SystemMessage $systemMessage) {
        $renderSystemMessages = $this->view->getViewHelper('RenderSystemMessages');
        if ($renderSystemMessages instanceof RenderSystemMessages) {
            $renderSystemMessages->addSystemMessage($systemMessage);
        }
    }

    /**
     * @param array $params
     *
     * @return void
     */
    protected function redirect(array $params) {
        header('Location: ' . $this->view->url($params, true));
        exit;
    }

}
