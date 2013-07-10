<?php
namespace RBMVC\Core\Controller\Helper;

use RBMVC\Core\Model\AbstractModel;
use RBMVC\Core\Utilities\SystemMessage;

class SaveModel extends AbstractActionHelper {
    
    /**
     * @param \RBMVC\Core\Model\AbstractModel $model
     * @param string $form
     */
    public function saveModel(AbstractModel $model, $form) {
        $modelId = (int) $this->request->getParam('id', 0);
        $params = $this->request->getPostParams();
        
        if (!empty($modelId)) {
            $model->setId($modelId)->init();
        } 
        
        $model->fillModelByArray($params);
        $form = new $form($model);
        if ($this->request->isPost()) {
            if ($form->isValid($params)) {
                $model = $model->save();
                if ($model instanceof AbstractModel) {
                    $systemMessage = new SystemMessage(SystemMessage::SUCCESS);
                    $systemMessage->setTitle('save_success');
                    $this->addFlashSystemMessage($systemMessage);
                    $this->redirect(array('id' => $model->getId()));
                }
            } else {
                $systemMessage = new SystemMessage(SystemMessage::ERROR);
                $systemMessage->setText('invalid_form'); 
                $this->addSystemMessage($systemMessage);
            }
        }
        
        $this->view->form = $form;    
        return $model;
    }
    
}
