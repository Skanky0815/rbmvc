<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 09:55
 * To change this template use File | Settings | File Templates.
 */

namespace Application\Lib\Controller;

use Application\Lib\Model\User;
use RBMVC\Core\Utilities\Session;

/**
 * Class AbstractController
 * @package Application\Lib\Controller
 */
abstract class AbstractController extends \RBMVC\Core\Controller\AbstractController {

    /**
     * @var \Application\Lib\Model\User
     */
    protected $user;

    /**
     * @return void
     */
    public function init() {
        parent::init();

        $session    = new Session('user');
        $this->user = $session->user;
        $this->view->assign('loggedUser', $this->user);
    }

    protected function indexParams($total) {
        $params      = $this->request->getParams();
        $limit       = isset($this->config['settings']['limit']) ? $this->config['settings']['limit'] : 15;
        $indexParams = array(
            'page'      => isset($params['page']) ? $params['page'] : 1,
            'limit'     => isset($params['limit']) ? $params['limit'] : $limit,
            'order_by'  => isset($params['order_by']) ? $params['order_by'] : 'id',
            'search'    => isset($params['search']) ? $params['search'] : '',
            'order_dir' => isset($params['order_dir']) ? $params['order_dir'] : 'DESC',
            'total'     => $total
        );

        /** @var $pagination \RBMVC\Core\View\Helper\Pagination */
        $pagination = $this->view->getViewHelper('Pagination');
        $pagination->setIndexParams($indexParams);

        return $indexParams;
    }

}