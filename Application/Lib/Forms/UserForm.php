<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 22:51
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Forms;

use RBMVC\Core\Utilities\Form\Elements\CheckboxElement;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Word;

/**
 * Class UserForm
 * @package Application\Lib\Forms
 */
class UserForm extends Form {

    /**
     * @return void
     */
    public function init() {

        $username = new InputElement('username', 'text');
        $username->setIsRequired(true);
        $username->setLabel('username');
        $username->setSize(InputElement::MINI);
        $username->addValidator(new Word);
        $this->addElement($username);

        $email = new InputElement('email', 'text');
        $email->setIsRequired(true);
        $email->setLabel('email');
        $email->setSize(InputElement::MINI);
        $email->addValidator(new Word);
        $this->addElement($email);

        $isActive = new CheckboxElement('is_active');
        $isActive->setLabel('is_active');
        $this->addElement($isActive);

    }

}