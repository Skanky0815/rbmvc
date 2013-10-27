<?php
namespace RBMVC\Core\Utilities\Form\Elements;

use RBMVC\Core\Translator;
use RBMVC\Core\Utilities\Form\Decorators\Element\AbstractDecorator;
use RBMVC\Core\Utilities\Form\Validators\AbstractValidator;

/**
 * Class AbstractElement
 * @package RBMVC\Core\Utilities\Form\Elements
 */
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
     * @var \RBMVC\Core\Utilities\Form\Decorators\Element\AbstractDecorator
     */
    protected $decorator = null;

    /**
     * @param $name
     * @param AbstractDecorator $decorator
     */
    public function __construct($name, AbstractDecorator $decorator) {
        $this->name       = $name;
        $this->decorator  = $decorator;
        $this->translator = Translator::getInstance();
    }

    /**
     * @param \RBMVC\Core\Utilities\Form\Validators\AbstractValidator $validator
     *
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function addValidator(AbstractValidator $validator) {
        $this->validators[] = $validator;

        return $this;
    }

    /**
     * @param array $validators
     *
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
     * @return \RBMVC\Core\Utilities\Form\Decorators\Element\AbstractDecorator
     */
    public function getDecorator() {
        return $this->decorator;
    }

    /**
     * @param \RBMVC\Core\Utilities\Form\Decorators\Element\AbstractDecorator $decorator
     *
     * @return AbstractElement
     */
    public function setDecorator(AbstractDecorator $decorator) {
        $this->decorator = $decorator;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorText() {
        return $this->errorText;
    }

    /**
     * @return string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setLabel($label) {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setName($name) {
        $this->name = $name;

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
     *
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasError() {
        return (bool) $this->hasError;
    }

    /**
     * @return boolean
     */
    public function isRequired() {
        return (bool) $this->isRequired;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function isValid(array $params) {
        if (array_key_exists($this->name, $params) && !empty($params[$this->name])) {
            /* @var $validator \RBMVC\Core\Utilities\Form\Validators\AbstractValidator */
            foreach ($this->validators as $validator) {
                if (!$validator->isValid($params[$this->name])) {
                    $this->hasError = true;

                    return $this->errorText = $validator->getErrorText();
                }
            }
        } else if ($this->isRequired) {
            $this->hasError = true;

            return $this->errorText = 'is_required';
        }

        return '';
    }

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {
        $this->decorator->setElement($this);

        return $this->decorator->render($template);
    }

    /**
     * @param boolean $isRequired
     *
     * @return \RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function setIsRequired($isRequired) {
        $this->isRequired = (bool) $isRequired;

        return $this;
    }

}