<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Utilities\Form\Validators\AbstractValidator;

abstract class AbstractElement {
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string 
     */
    protected $label = '';
    
    /**
     * @var string 
     */
    protected $value;
    
    /**
     * @var boolean 
     */
    protected $isRequired;
    
    /**
     * @var string 
     */
    protected $errorText;

    /**
     * @var boolean
     */
    protected $hasError = false;
    
    /**
     * @var \RBMVC\Core\Translator 
     */
    protected $translator;
    
    /**
     * @var array
     */
    protected $validators = array();
    
    /**
     * @param string $name
     * @return string
     */
    public function __construct($name) {
        $this->name = $name;
        $this->translator = \RBMVC\Core\Translator::getInstance();
    }
    
    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * @param string $name
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }
    
    /**
     * @param string $label
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * @param string $value
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setValue($value) {
        $this->value = $value;
        return $this;
    }
    
    /**
     * @param boolean $isRequired
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setIsRequired($isRequired) {
        $this->isRequired = (bool) $isRequired;
        return $this;
    }
    
    /**
     * @return boolean
     */
    public function isRequired() {
        return (bool) $this->isRequired;
    }
    
    /**
     * @param \RBMVC\Core\Utilities\Form\Validators\AbstractValidator $validator
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function addValidator(AbstractValidator $validator) {
        $this->validators[] = $validator;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getErrorText() {
        return $this->errorText;
    }
    
    /**
     * @return boolean
     */
    public function hasError() {
        return (bool) $this->hasError;
    }
    
    /**
     * @param array $validators
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function addValidators(array $validators) {
        foreach ($validators as $validator) {
            if ($validator instanceof AbstractValidator) {
                $this->validators[] = $validator;
            }
        }
        return $this;
    }
    
    /**
     * @param array $parmas
     * @return string
     */
    public function isValid(array $parmas) {
        if (array_key_exists($this->name, $parmas) && !empty($parmas[$this->name])) {
            /* @var $validator \RBMVC\Core\Utilities\Form\Validators\AbstractValidator */
            foreach ($this->validators as $validator) {
                if (!$validator->isValid($parmas[$this->name])) {
                    $this->hasError = true;
                    return $this->errorText = $validator->getErrorText();
                }
            }
        } else if($this->isRequired) {
            $this->hasError = true;
            return $this->errorText = 'is_required';
        }
    }
    
}