<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\SystemMessage;
use RBMVC\Core\Utilities\Session;

class RenderSystemMessages extends AbstractHelper {
    
    /**
     * @var array 
     */
    private $systemMessages = array();
    
    /**
     * @return void
     */
    public function __construct() {
        $session = new Session('system_message');
        if (is_null($session->systemMessages) 
                || !is_array($session->systemMessages)) {
            return;
        }
        
        foreach ($session->systemMessages as $systemMessage) {
            $systemMessage = unserialize($systemMessage);
            if (!$systemMessage instanceof SystemMessage) {
                continue;
            }
            
            $this->systemMessages[] = $systemMessage;
        }
        
        $session->resetNamespace();
    }

    /**
     * @param \RBMVC\Core\Utilities\SystemMessage $systemMessage
     * @return \RBMVC\Core\View\Helper\RenderSystemMessages
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
