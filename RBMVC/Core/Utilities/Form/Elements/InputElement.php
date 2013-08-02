<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Elements\AbstractElement;

class InputElement extends AbstractElement {
    
    const MINI      = 'input-mini';
    const SMALL     = 'input-small';
    const MEDIUM    = 'input-medium';
    const LARGE     = 'input-large';
    const X_LARGE    = 'input-xlarge';
    const XX_LARGE   = 'input-xxlarge';
    
    /**
     * @var string 
     */
    private $type;
    
    /**
     * @var string
     */
    private $placeholder = '';
    
    /**
     * @var string 
     */
    private $size = self::LARGE;
    
    /**
     * @param string $name
     * @param string $type
     * @return void
     */
    public function __construct($name, $type) {
        $this->type = $type;
        parent::__construct($name);
    }

    /**
     * @return string
     */
    public function getSize() {
        return $this->size;
    }
    
    /**
     * @param string $size
     * @return \RBMVC\Core\Utilities\Form\Elements\InputElement
     */
    public function setSize($size) {
        $this->size = $size;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getPlaceholder() {
        return $this->placeholder;
    }
    
    /**
     * @param string $placeholder
     * @return \RBMVC\Core\Utilities\Form\Elements\InputElement
     */
    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;
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
     * @return \RBMVC\Core\Utilities\Form\Elements\InputElement
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }
    
}