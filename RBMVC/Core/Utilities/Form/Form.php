<?php
namespace RBMVC\Core\Utilities\Form;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator;
use RBMVC\Core\Utilities\Form\Decorators\ButtonGroup;
use RBMVC\Core\Utilities\Form\Decorators\DefaultDecorator;
use RBMVC\Core\Utilities\Form\Elements\AbstractElement;
use RBMVC\Core\Utilities\Form\Elements\ButtonElement;
use RBMVC\Core\Utilities\Form\Elements\Link;
use RBMVC\Core\View\Helper\Url;
use RBMVC\Core\View\View;

/**
 * Class Form
 * @package RBMVC\Core\Utilities\Form
 */
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
     * @var array
     */
    private $displayGroups;

    /**
     * @var boolean
     */
    private $hasActionBar = true;

    /**
     * @var View
     */
    private $view = null;

    /**
     * @param View $view
     * @param array|AbstractModel $object
     */
    public function __construct(View $view, $object = array()) {
        if (is_object($object) && $object instanceof AbstractModel) {
            $object = $object->toArray();
        }

        $this->view   = $view;
        $this->object = $object;
        $this->init();
        $this->setElementsValue();
    }

    /**
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return \RBMVC\Core\Utilities\Form\Form
     */
    public function setAction($action) {
        $this->action = $action;

        return $this;
    }

    /**
     * @param array $elements
     * @param string $name
     * @param AbstractDecorator $decorator
     *
     * @return void
     */
    public function addDisplayGroup(array $elements, $name, AbstractDecorator $decorator = null) {
        $elementsNames = array();
        foreach ($elements as $element) {
            if ($element instanceof AbstractElement) {
                $elementsNames[] = $element;
            } else if (is_string($element)) {
                $elementsNames = $this->getElement($element);
            }
        }

        $displayGroup = new DisplayGroup();
        $displayGroup->setName($name);
        $displayGroup->setElements($elementsNames);
        $displayGroup->setDecorator(is_null($decorator) ? new DefaultDecorator() : $decorator);

        $this->displayGroups[$name] = $displayGroup;
    }

    /**
     * @param AbstractElement $element
     *
     * @return \RBMVC\Core\Utilities\Form\Form
     */
    public function addElement(AbstractElement $element) {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return \RBMVC\Core\Utilities\Form\DisplayGroup|null
     */
    public function getDisplayGroup($name) {
        return isset($this->displayGroups[$name]) ? $this->displayGroups[$name] : null;
    }

    /**
     * @return array
     */
    public function getDisplayGroups() {
        return $this->displayGroups;
    }

    /**
     * @param string $name
     *
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
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @param array $errors
     *
     * @return Form
     */
    public function setErrors($errors) {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @return array
     */
    public function getObject() {
        return $this->object;
    }

    /**
     * @param array $object
     *
     * @return Form
     */
    public function setObject($object) {
        $this->object = $object;

        return $this;
    }

    /**
     * @param string $index
     * @param mixed $default
     *
     * @return mixed
     */
    public function getObjectValue($index, $default = '') {
        if (array_key_exists($index, $this->object) && !empty($this->object[$index])) {
            return $this->object[$index];
        }

        return $default;
    }

    /**
     * @return \RBMVC\Core\View\View
     */
    public function getView() {
        return $this->view;
    }

    /**
     * @param View $view
     *
     * @return Form
     */
    public function setView(View $view) {
        $this->view = $view;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasActionBar() {
        return $this->hasActionBar;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasDisplayGroup($name) {
        return isset($this->displayGroups[$name]);
    }

    /**
     * @param array $params
     *
     * @return boolean
     */
    public function isValid(array $params) {
        $isValid = true;
        /* @var AbstractElement $element */
        foreach ($this->elements as $element) {
            $error = $element->isValid($params);
            if (!empty($error)) {
                $this->errors[$element->getName()] = $error;
                $isValid                           = false;
            }
        }

        return $isValid;
    }

    /**
     * @param boolean $hasActionBar
     *
     * @return \RBMVC\Core\Utilities\Form\Form
     */
    public function setHasActionBar($hasActionBar) {
        $this->hasActionBar = (boolean) $hasActionBar;

        return $this;
    }

    /**
     * @return void
     */
    protected function addDefaultActions() {
        $position = isset($this->displayGroups['actions_top']) ? '_bottom' : '_top';

        $save = new ButtonElement('save');
        $save->setType(ButtonElement::BTN_SUCCESS);
        $abort = new Link('abort');
        $abort->setType(Link::LAYOUT_DEFAULT);
        $abort->setTarget(Link::TARGET_SELF);

        /** @var Url $urlHelper */
        $urlHelper = $this->view->getViewHelper('Url');
        $abort->setUrl($urlHelper->url(array('action' => 'index')));

        $this->addDisplayGroup(array($save, $abort), 'actions' . $position, new ButtonGroup());
    }

    /**
     * @return void
     */
    abstract protected function init();

    /**
     * @return void
     */
    private function setElementsValue() {
        /* @var $element \RBMVC\Core\Utilities\Form\Elements\AbstractElement */
        foreach ($this->elements as $element) {
            $element->setValue($this->getObjectValue($element->getName()));
        }
    }

}