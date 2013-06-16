<?php
namespace RBMVC\Core\Utilities\Form\Elements;

class TextareaElement extends AbstractElement {
    
    /**
     * @var integer
     */
    private $rows;
    
    /**
     * @var string
     */
    private $placeholder;
    
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
}
