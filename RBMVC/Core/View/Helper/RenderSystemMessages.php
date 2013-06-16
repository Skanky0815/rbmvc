<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Utilities\SystemMessage;

class RenderSystemMessages extends AbstractHelper {
    
    /**
     * @var array 
     */
    private $systemMessages = array();

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
            $out .= $this->view->partial('systemMessage.phtml', array('systemMessage' => $systemMessage));
        }
        return $out;
    }
}
