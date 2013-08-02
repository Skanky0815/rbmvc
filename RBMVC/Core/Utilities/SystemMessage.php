<?php
namespace RBMVC\Core\Utilities;

class SystemMessage {
    
    const SUCCESS   = 'success';
    const ERROR     = 'error';
    const WARNING   = 'block';
    const INFO      = 'info';
    
    /**
     * @var string 
     */
    private $title = '';
    
    /**
     * @var string 
     */
    private $text = '';
    
    /**
     * @var string 
     */
    private $type = '';
    
    /**
     * @param string $type
     */
    public function __construct($type = self::INFO) {
        $this->type = $type;
        
        switch ($type) {
            case self::SUCCESS:
                $this->title = 'message_success';
                break;
            case self::WARNING:
                $this->title = 'message_warning';
                break;
            case self::ERROR:
                $this->title = 'message_error';
                break;
            case self::INFO:
                $this->title = 'message_info';
                break;
        }
    }
    
    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @param string $title
     * @return \RBMVC\Core\Utilities\SystemMessage
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text
     * @return \RBMVC\Core\Utilities\SystemMessage
     */
    public function setText($text) {
        $this->text = $text;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     * @return \RBMVC\Core\Utilities\SystemMessage
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

}