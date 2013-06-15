<?php
namespace RBMVC\Core\Forms;

use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Elements\InputElement;

class LoginForm extends Form {
    
    protected function init() {
        $username = new InputElement('username', 'text');
        $username->setIsRequired(true);
        $username->setPlaceholder('username');
        $username->setSize(InputElement::SMALL);
        $this->addElement($username);
        
        $password = new InputElement('password', 'password');
        $password->setIsRequired(true);
        $password->setPlaceholder('passwort');
        $password->setSize(InputElement::SMALL);
        $this->addElement($password);
    }
}