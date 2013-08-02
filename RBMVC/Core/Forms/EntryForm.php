<?php
namespace RBMVC\Core\Forms;

use RBMVC\Core\Utilities\Form\Elements\HiddenElement;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Numeric;
use RBMVC\Core\Utilities\Form\Validators\Word;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Elements\TextareaElement;

class EntryForm extends Form {
    
    /**
     * @return void
     */
    public function init() {
        $author = new HiddenElement('user_id');
        $author->addValidator(new Numeric());
        $this->addElement($author);
        
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
    }    
}