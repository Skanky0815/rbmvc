<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:54
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Forms;

use RBMVC\Core\Utilities\Form\DisplayGroup;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Elements\TextareaElement;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Word;

/**
 * Class UserGroupForm
 * @package Application\Lib\Forms
 */
class UserGroupForm extends Form {

    /**
     * @return void
     */
    protected function init() {
        $this->addDefaultActions();

        $name = new InputElement('name', 'text');
        $name->setLabel('name');
        $name->addValidator(new Word());
        $name->setIsRequired(true);
        $this->addElement($name);

        $description = new TextareaElement('description');
        $description->setLabel('description');
        $description->addValidator(new Word());
        $this->addElement($description);

        $this->addDisplayGroup(array($name, $description), DisplayGroup::DEFAULT_ELEMENTS);

        $this->addDefaultActions();
    }

}