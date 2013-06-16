<?php
namespace RBMVC\Core\Utilities\Form\Validators;

class Integer extends AbstractValidator {
    
    /**
     * @return void
     */
    public function __construct() {
        $this->errorText = 'is_no_integer';
    }
    
    /**
     * @param string $value
     * @return boolean
     */
    protected function validate($value) {
        return is_numeric($value) && is_int($value);
    }    
}