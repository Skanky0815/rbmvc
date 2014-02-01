<?php
namespace Application\Lib\Forms;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Decorators\Element\AssignItem;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Elements\TextareaElement;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Word;

/**
 * Class EntryForm
 * @package Application\Lib\Forms
 */
class EntryForm extends Form {

    /**
     * @return void
     */
    public function init() {
        $this->addDefaultActions();

        $title = new InputElement('title', 'text');
        $title->setIsRequired(true);
        $title->setLabel('title');
        $title->setSize(InputElement::MEDIUM);
        $title->addValidator(new Word);
        $this->addElement($title);

        $text = new TextareaElement('text');
        $text->setIsRequired(true);
        $text->setLabel('text');
        $text->addValidator(new Word());
        $this->addElement($text);

        $this->addI81nFields(array($title, $text));

        $this->addDefaultActions();
    }

    /**
     * @param AbstractModel $model
     *
     * @return AssignItem
     */
    protected function fillAssignItem(AbstractModel $model) { }
}