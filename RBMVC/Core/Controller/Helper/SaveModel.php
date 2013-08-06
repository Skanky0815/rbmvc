<?php
namespace RBMVC\Core\Controller\Helper;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\Form\Form;
use RBMVC\Core\Utilities\Session;
use RBMVC\Core\Utilities\SystemMessage;

class SaveModel extends AbstractActionHelper {

    /**
     * @param \RBMVC\Core\Model\AbstractModel $model
     * @param string $form
     *
     * @return \RBMVC\Core\Model\AbstractModel|void
     */
    public function saveModel(AbstractModel $model, $form) {
        $modelId = (int) $this->request->getParam('id', 0);
        $params  = $this->request->getPostParams();

        if (!empty($modelId)) {
            $model->setId($modelId)->init();
        }

        $model->fillModelByArray($params);
        $form = new $form($model);

        if (!$form instanceof Form) {
            return $model;
        }

        if ($this->request->isPost()) {
            if ($form->isValid($params)) {
                $this->save($model);
            } else {
                $this->addInvalidFormMessage();
            }
        }

        $session = new Session('saved');

        $this->view->assign('isSavedIcon', $this->view->partial('layout/partials/isSavedIcon.phtml', array('isSaved' => $session->saved)));
        $this->view->assign('form', $form);

        $session->resetNamespace();

        return $model;
    }

    /**
     * @param \RBMVC\Core\Model\AbstractModel $model
     *
     * @return void
     */
    private function save(AbstractModel &$model) {
        $temp = $model;
        if ($model->save() instanceof AbstractModel) {
            $systemMessage = new SystemMessage(SystemMessage::SUCCESS);
            $systemMessage->setTitle('save_success');
            $this->addFlashSystemMessage($systemMessage);

            $session        = new Session('saved');
            $session->saved = true;

            $this->redirect(array('id' => $model->getId()));
        } else {
            $model = $temp;
            $this->addSaveErrorMessage();
        }
    }

    /**
     * @return void
     */
    private function addSaveErrorMessage() {
        $systemMessage = new SystemMessage(SystemMessage::ERROR);
        $systemMessage->setTitle('save_error');
        $this->addSystemMessage($systemMessage);
    }

    /**
     * @return void
     */
    private function addInvalidFormMessage() {
        $systemMessage = new SystemMessage(SystemMessage::ERROR);
        $systemMessage->setTitle('invalid_form');
        $this->addSystemMessage($systemMessage);
    }

}
