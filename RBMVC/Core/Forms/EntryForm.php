<?php
namespace RBMVC\Core\Forms;

use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Validators\Word;

class EntryForm extends Form {
    
    /**
     * @return void
     */
    public function init() {
        $author = new InputElement('author', 'text');
        $author->setIsRequired(true);
        $author->setLabel('author');
        $author->setSize(InputElement::MINI);
        $author->addValidator(new Word());
        $this->addElement($author);
    }    
}