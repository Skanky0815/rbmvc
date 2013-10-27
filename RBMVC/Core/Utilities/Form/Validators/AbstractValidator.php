<?php
namespace RBMVC\Core\Utilities\Form\Validators;

abstract class AbstractValidator {

    /**
     * @var string
     */
    protected $errorText;

    public function __construct() {
        $this->errorText = 'missing error text for this validator: "' . __CLASS__ . '"';
    }

    /**
     * @param string $value
     *
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
     * @param string $errorText
     *
     * @return \RBMVC\Core\Utilities\Form\Validators\AbstractValidator
     */
    public function setErrorText($errorText) {
        $this->errorText = $errorText;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return boolean
     */
    abstract protected function validate($value);

}