<?php
namespace RBMVC\Core\Utilities\Form\Validators;

class Word extends AbstractValidator {

    public function __construct() {
        parent::__construct();
        $this->errorText = 'is_no_word';
    }

    /**
     * @param string $value
     *
     * @return boolean
     */
    protected function validate($value) {
        return is_string($value) && !is_numeric($value);
    }
}
