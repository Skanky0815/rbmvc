<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;

/**
 * Class RenderSystemMessages
 * @package RBMVC\Core\View\Helper
 */
class RenderSystemMessages extends AbstractViewHelper {

    /**
     * @var array
     */
    private $systemMessages = array();

    /**
     *
     */
    public function __construct() {
        $session = new Session('system_message');
        if (is_null($session->systemMessages)
            || !is_array($session->systemMessages)
        ) {
            return;
        }

        foreach ($session->systemMessages as $systemMessage) {
            if (!$systemMessage instanceof SystemMessage) {
                continue;
            }

            $this->systemMessages[] = $systemMessage;
        }

        $session->resetNamespace();
    }

    /**
     * @param SystemMessage $systemMessage
     *
     * @return RenderSystemMessages
     */
    public function addSystemMessage(SystemMessage $systemMessage) {
        $this->systemMessages[] = $systemMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function renderSystemMessages() {
        $out = '';

        foreach ($this->systemMessages as $systemMessage) {
            $out .= $this->view->partial('layout/partials/systemMessage.phtml',
                array('systemMessage' => $systemMessage)
            );
        }

        return $out;
    }
}
