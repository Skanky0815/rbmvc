<?php
namespace RBMVC\Core\Utilities\Form\Validators;

class Numeric extends AbstractValidator {
    
    public function __construct() {
        parent::__construct();
        $this->errorText = 'is_no_number';
    }
    
    /**
     * @param string $value
     * @return boolean
     */
    protected function validate($value) {
        return is_numeric($value);
    }

}