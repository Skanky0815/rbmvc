<?php
namespace RBMVC\Core\Utilities\Form;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Elements\AbstractElement;

abstract class Form {
    
    /**
     * @var array 
     */
    private $elements = array();
    
    /**
     * @var array
     */
    private $errors = array();
    
    /**
     * @var array 
     */
    private $object;
    
    /**
     * @var string
     */
    private $action = '';
    
    /**
     * @var boolean
     */
    private $hasActionBar = true;

    /**
     * @param array|AbstractModel $object
     */
    public function __construct($object = array()) {
        if (is_object($object) && $object instanceof AbstractModel) {
            $object = $object->toArray();
        }

        $this->object = $object;
        $this->init();
        $this->setElementsValue();
    }
    
    /**
     * @param string $action
     * @return \RBMVC\Core\Utilities\Form\Form
     */
    public function setAction($action) {
        $this->action = $action;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getAction() {
        return $this->action;
    }
    
    /**
     * @return void
     */
    private function setElementsValue() {
        /* @var $element \RBMVC\Core\Utilities\Form\Elements\AbstractElement */
        foreach ($this->elements as $element) {
            $element->setValue($this->getObjectValue($element->getName()));
        }
    }
    
    /**
     * @param boolean $hasActionBar
     * @return \RBMVC\Core\Utilities\Form\Form
     */
    public function setHasActionBar($hasActionBar) {
        $this->hasActionBar = (boolean) $hasActionBar;
        return $this;
    }
    
    /**
     * @return boolean
     */
    public function hasActionBar() {
        return $this->hasActionBar;
    }
    
    /**
     * @param string $index
     * @param mixed $default
     * @return mixed
     */
    public function getObjectValue($index, $default = '') {
        if (array_key_exists($index, $this->object) && !empty($this->object[$index])) {
            return $this->object[$index];
        }
        return $default;
    }
    
    /**
     * @return void
     */
    abstract protected function init();
    
    /**
     * @param \RBMVC\Core\Utilities\Form\Elements\AbstractElement $element
     * @return \RBMVC\Core\Utilities\Form\Form
     */
    public function addElement(AbstractElement $element) {
        $this->elements[] = $element;
        return $this;
    }
    
    /**
     * @param string $name
     * @return null|\RBMVC\Core\Utilities\Form\Elements\AbstractElement
     */
    public function getElement($name) {
        if (array_key_exists($name, $this->elements)) {
            return $this->elements[$name];
        }
        return null;
    }
    
    /**
     * @return array
     */
    public function getElements() {
        return $this->elements;
    }
    
    /**
     * @param array $params
     * @return boolean
     */
    public function isValid(array $params) {
        $isValid = true; 
        /* @var \RBMVC\Core\Utilities\Form\Elements\AbstractElement $element */
        foreach ($this->elements as $element) {
            $error = $element->isValid($params);
            if (!empty($error)) {
                $this->errors[$element->getName()] = $error;
                $isValid = false;
            }
        }
        return $isValid;
    }
    
}