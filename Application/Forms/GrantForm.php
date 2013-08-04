<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 12:04
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Forms;

use Application\Model\Grant;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Elements\CheckboxElement;
use RBMVC\Core\Utilities\Form\Elements\TextareaElement;
use RBMVC\Core\Utilities\Form\Elements\SelectElement;
use RBMVC\Core\Utilities\Form\Validators\Word;

class GrantForm extends Form {

    /**
     * @return void
     */
    protected function init() {

        $definition = new InputElement('definition', 'text');
        $definition->setIsRequired(true);
        $definition->setLabel('definition');
        $definition->setSize(InputElement::MEDIUM);
        $definition->addValidator(new Word);
        $this->addElement($definition);

        $type = new SelectElement('type');
        $type->setLabel('type');
        $type->setOptions(array(
            'grant_type_' . Grant::TYPE_PUBLIC    => Grant::TYPE_PUBLIC,
            'grant_type_' . Grant::TYPE_PROTECTED => Grant::TYPE_PROTECTED,
            'grant_type_' . Grant::TYPE_PRIVATE   => Grant::TYPE_PRIVATE,
        ));
        $this->addElement($type);

        $description = new TextareaElement('description');
        $description->setIsRequired(false);
        $description->setLabel('description');
        $description->addValidator(new Word());
        $this->addElement($description);

        $isActive = new CheckboxElement('is_active');
        $isActive->setLabel('is_active');
        $this->addElement($isActive);
    }

}