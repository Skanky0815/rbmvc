<?php
namespace Application\Lib\Forms;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Decorators\Element\AssignItem;
use RBMVC\Core\Utilities\Form\DisplayGroup;
use RBMVC\Core\Utilities\Form\Elements\HiddenElement;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Elements\TextareaElement;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Numeric;
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

        $author = new HiddenElement('user_id');
        $author->addValidator(new Numeric());
        $this->addElement($author);

        $this->addDisplayGroup(array($author), DisplayGroup::HIDDEN_ELEMENTS);

        $title = new InputElement('title', 'text');
        $title->setIsRequired(true);
        $title->setLabel('title');
        $title->setSize(InputElement::X_LARGE);
        $title->addValidator(new Word);
        $this->addElement($title);

        $text = new TextareaElement('text');
        $text->setIsRequired(true);
        $text->setLabel('text');
        $text->addValidator(new Word());
        $this->addElement($text);

        $this->addDisplayGroup(array($title, $text), DisplayGroup::DEFAULT_ELEMENTS);

        $this->addDefaultActions();
    }

    /**
     * @param AbstractModel $model
     *
     * @return AssignItem
     */
    protected function fillAssignItem(AbstractModel $model) {
        // TODO: Implement fillAssignItem() method.
    }
}