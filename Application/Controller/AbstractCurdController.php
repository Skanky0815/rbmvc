<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:59
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Controller;

abstract class AbstractCurdController extends AbstractController {

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $modelClassName = '';

    /**
     * @var string
     */
    private $formClassName = '';

    /**
     * @var string
     */
    private $collectionClassName = '';

    public function __construct($name) {
        $this->name                = lcfirst($name);
        $this->modelClassName      = 'Application\Model\\' . $name;
        $this->formClassName       = 'Application\Forms\\' . $name . 'Form';
        $this->collectionClassName = 'Application\Model\Collection\\' . $name . 'Collection';
    }

    /**
     * @return void
     */
    public function indexAction() {
        $collection = $this->classLoader->getClassInstance($this->collectionClassName);
        $collection->findAll();
        $this->view->assign($this->name . 's', $collection->getModels());
    }

    /**
     * @return void
     */
    public function addAction() {
        $this->redirect(array('action' => 'edit'));
    }

    /**
     * @return void
     */
    public function editAction() {
        $model = $this->classLoader->getClassInstance($this->modelClassName);
        $user  = $this->saveModel($model, $this->formClassName);
        $this->view->assign($this->name, $user);
    }

    /**
     * @return string
     */
    public function deleteAction() {
        $this->view->disableRender();
        $id = $this->request->getParam('id', 0);

        if (empty($id)) {
            return $this->sendJSON(
                array('status' => 'error'
                      , 'text' => 'keine gültige id'
                )
            );
        }

        $model = $this->classLoader->getClassInstance($this->modelClassName);
        $model->setId($id)->delete();

        return $this->sendJSON(
            array('status' => 'ok'
                  , 'data' => array('id' => $id)
            )
        );
    }

}