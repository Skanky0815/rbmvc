<?php
namespace Application\Forms;

use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Word;
use RBMVC\Core\Utilities\Form\Elements\ButtonElement;
use RBMVC\Core\Utilities\Form\Elements\InputElement;

class LoginForm extends Form {
    
    /**
     * @return void
     */
    protected function init() {
        $username = new InputElement('username', 'text');
        $username->setIsRequired(true);
        $username->setLabel('username');
        $username->setPlaceholder('username');
        $username->addValidator(new Word());
        $username->setSize(InputElement::SMALL);
        $this->addElement($username);
        
        $password = new InputElement('password', 'password');
        $password->setIsRequired(true);
        $password->setLabel('password');
        $password->setPlaceholder('password');
        $password->setSize(InputElement::SMALL);
        $this->addElement($password);
        
        $submit = new ButtonElement('login');
        $this->addElement($submit);
        
        $this->setHasActionBar(false);
    }
}