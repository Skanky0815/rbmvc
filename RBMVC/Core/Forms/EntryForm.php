<?php
namespace RBMVC\Core\Forms;

use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Word;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Elements\TextareaElement;

class EntryForm extends Form {
    
    /**
     * @return void
     */
    public function init() {
        $author = new InputElement('author', 'text');
        $author->setIsRequired(true);
        $author->setLabel('author');
        $author->setSize(InputElement::MEDIUM);
        $author->addValidator(new Word());
        $this->addElement($author);
        
        $title = new InputElement('title', 'text');
        $title->setIsRequired(true);
        $title->setLabel('title');
        $title->setSize(InputElement::XLARGE);
        $title->addValidator(new Word);
        $this->addElement($title);
        
        $text = new TextareaElement('text');
        $text->setIsRequired(true);
        $text->setLabel('text');
        $text->addValidator(new Word());
        $this->addElement($text);
    }    
}