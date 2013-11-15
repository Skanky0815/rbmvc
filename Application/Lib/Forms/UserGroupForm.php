<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:54
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Forms;

use Application\Lib\Model\Collection\GrantCollection;
use Application\Lib\Model\Grant;
use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Decorators\Element\AssignItem;
use RBMVC\Core\Utilities\Form\DisplayGroup;
use RBMVC\Core\Utilities\Form\Elements\Assign;
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

        $grantsCollection = new GrantCollection();
        $grantsCollection->findByType(Grant::TYPE_PRIVATE);
        $grantAssign = new Assign('grants');
        $grantAssign->setLabel('grant_assign');
        $grantAssign->setUnAssigned($this->createAssignItems($grantsCollection->getModels()));
        $this->addElement($grantAssign);

        $this->addDisplayGroup([$name, $description, $grantAssign], DisplayGroup::DEFAULT_ELEMENTS);

        $this->addDefaultActions();
    }

    /**
     * @param AbstractModel $model
     *
     * @return AssignItem|null
     */
    protected function fillAssignItem(AbstractModel $model) {
        if (!$model instanceof Grant) {
            return null;
        }

        $assignItem = new AssignItem();
        $assignItem->setTitle($model->getDefinition());
        $assignItem->setValue($model->getId());

        return $assignItem;
    }
}