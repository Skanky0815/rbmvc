<?php
namespace RBMVC\Core\Utilities\Form;

use Application\Lib\Model\Collection\LanguageCollection;
use Application\Lib\Model\Language;
use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Model\I18n;
use RBMVC\Core\Utilities\Form\Decorators\AbstractDecorator;
use RBMVC\Core\Utilities\Form\Decorators\ButtonGroup;
use RBMVC\Core\Utilities\Form\Decorators\DefaultDecorator;
use RBMVC\Core\Utilities\Form\Decorators\Element\AssignItem;
use RBMVC\Core\Utilities\Form\Decorators\I81N;
use RBMVC\Core\Utilities\Form\Elements\AbstractElement;
use RBMVC\Core\Utilities\Form\Elements\ButtonElement;
use RBMVC\Core\Utilities\Form\Elements\Link;
use RBMVC\Core\Utilities\Modifiers\String\GetClassNameWithUnderscore;
use RBMVC\Core\View\Helper\Url;
use RBMVC\Core\View\View;

/**
 * Class Form
 * @package RBMVC\Core\Utilities\Form
 */
abstract class Form {

    /**
     * @var AbstractElement[]
     */
    private $elements = array();

    /**
     * @var array
     */
    private $errors = array();

    /**
     * @var AbstractModel
     */
    private $object = null;

    /**
     * @var string
     */
    private $action = '';

    /**
     * @var DisplayGroup[]
     */
    private $displayGroups = array();

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
     * @param AbstractModel $object
     */
    public function __construct(View $view, $object) {
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
     * @return Form
     */
    public function setAction($action) {
        $this->action = $action;

        return $this;
    }

    /**
     * @param AbstractElement[] $elements
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
     * @return Form
     */
    public function addElement(AbstractElement $element) {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return DisplayGroup|null
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
     * @return null|AbstractElement
     */
    public function getElement($name) {
        if (array_key_exists($name, $this->elements)) {
            return $this->elements[$name];
        }

        return null;
    }

    /**
     * @return AbstractElement[]
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
     * @return string|int|AbstractModel|AbstractModel[]
     */
    public function getObjectValue($index, $default = '') {
        $reflectionClass = new \ReflectionClass($this->object);
        $methodName      = 'get' . ucfirst($index);
        if ($reflectionClass->hasMethod($methodName)) {
            $value = $this->object->{$methodName}();
            if (!empty($value)) {
                return $this->object->{$methodName}();
            }
        }

        return $default;
    }

    /**
     * @return View
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
     * @return Form
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
     * @param AbstractModel[] $models
     *
     * @return AssignItem[]
     */
    protected function createAssignItems(array $models) {
        $items = [];
        foreach ($models as $model) {
            $item                     = $this->fillAssignItem($model);
            $items[$item->getValue()] = $item;
        }

        return $items;
    }

    /**
     * @param AbstractModel $model
     *
     * @return AssignItem
     */
    abstract protected function fillAssignItem(AbstractModel $model);

    /**
     * @return void
     */
    abstract protected function init();

    /**
     * @param AbstractElement[] $elements
     */
    protected function addI81nFields(array $elements) {
        $languageCollection = new LanguageCollection();
        $languageCollection->findAll();

        /** @var Language[] $languages */
        $languages = $languageCollection->getModels();

        $getClassNameWithUnderscore = new GetClassNameWithUnderscore();
        $className = $getClassNameWithUnderscore->getClassName($this->object);

        $i81nElements = array();
        foreach ($elements as $key => $element) {
            foreach ($languages as $language) {
                $cElement = clone $element;
                $name = 'i81n[' . $language->getId() . '][' . $cElement->getName() . ']';

                $i81n = new I18n();
                $i81n->setObjectId($this->object->getId())
                    ->setClassname($className)
                    ->setLanguageId($language->getId())
                    ->setField($cElement->getName())
                    ->init();

                $cElement->setValue($i81n->getValue());
                $i81nElements[$language->getId()][] = $cElement->setName($name);
            }

            unset($this->elements[$key]);
        }

        $i81nDecorator = new I81N();
        $i81nDecorator->setLanguages($languages);

        $displayGroup = new DisplayGroup();
        $displayGroup->setName(DisplayGroup::I81N);
        $displayGroup->setElements($i81nElements);
        $displayGroup->setDecorator($i81nDecorator);

        $this->displayGroups[DisplayGroup::I81N] = $displayGroup;
    }

    /**
     * @return void
     */
    private function setElementsValue() {
        foreach ($this->elements as $element) {
            $value = $this->getObjectValue($element->getName());
            if (is_array($value) && $value[0] instanceof AbstractModel) {
                $value = $this->createAssignItems($value);
            }
            $element->setValue($value);
        }
    }

}