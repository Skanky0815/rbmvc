<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 04.08.13
 * Time: 15:59
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Controller;

/**
 * Class AbstractRudiController
 * @package Application\Lib\Controller
 */
abstract class AbstractRudiController extends AbstractController {

    /**
     * @var string
     */
    private $name = '';

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
        $this->modelClassName      = 'Application\Lib\Model\\' . $name;
        $this->formClassName       = 'Application\Lib\Forms\\' . $name . 'Form';
        $this->collectionClassName = 'Application\Lib\Model\Collection\\' . $name . 'Collection';
    }

    /**
     * @return void
     */
    public function indexAction() {
        /** @var $collection \RBMVC\Core\Model\Collection\AbstractCollection */
        $collection = $this->classLoader->getClassInstance($this->collectionClassName);
        $collection->findAll();
        $total = count($collection->getResult());
        $collection->setIndexParams($this->indexParams($total));
        $collection->findForIndex();
        $this->view->assign($this->name . 's', $collection->getModels());
    }

    /**
     * @return string
     */
    public function deleteAction() {
        $this->view->disableRender();
        $id = (int) $this->request->getParam('id', 0);

        if (empty($id)) {
            return $this->sendJSON(
                array('status' => 'ok', 'content' => $this->view->partial('layout/partials/deleteModal.phtml'))
            );
        }

        $model = $this->classLoader->getClassInstance($this->modelClassName);
        $model->setId($id)->delete();

        return $this->sendJSON(array('status' => 'ok', 'content' => array('id' => $id)));
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
}