<?php
namespace RBMVC\Core\Utilities\Form\Validators;

abstract class AbstractValidator {
    
    /**
     * @var string 
     */
    protected $errorText = '';
    
    /**
     * @param string $value
     * @return boolean
     */
    public function isValid($value) {
        return (bool) $this->validate($value);
    }
    
    /**
     * @return string
     */
    public function getErrorText() {
        return $this->errorText;
    }
    
    /**
     * @param string $value
     * @return boolean
     */    
    abstract protected function validate($value);
        
}