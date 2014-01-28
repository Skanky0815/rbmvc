<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 17:53
 */

namespace Application\Lib\Forms;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Decorators\Element\AssignItem;
use RBMVC\Core\Utilities\Form\DisplayGroup;
use RBMVC\Core\Utilities\Form\Elements\InputElement;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Form\Validators\Word;

/**
 * Class LanguageForm
 * @package Application\Lib\Forms
 */
class LanguageForm extends Form {

    /**
     * @param AbstractModel $model
     *
     * @return AssignItem
     */
    protected function fillAssignItem(AbstractModel $model) {
        // TODO: Implement fillAssignItem() method.
    }

    /**
     * @return void
     */
    protected function init() {
        $this->addDefaultActions();

        $username = new InputElement('code', 'text');
        $username->setIsRequired(true);
        $username->setLabel('languagecode');
        $username->setSize(InputElement::MINI);
        $username->addValidator(new Word);
        $this->addElement($username);

        $this->addDisplayGroup([$username], DisplayGroup::DEFAULT_ELEMENTS);

        $this->addDefaultActions();
    }

} 