<?php
namespace Application\Controller;

use Application\Lib\Controller\AbstractController;

/**
 * Class ErrorController
 * @package Application\Controller
 */
class ErrorController extends AbstractController {

    /**
     * @return void
     */
    public function indexAction() {
        $statusCode = $this->request->getParam('c');
        if (empty($statusCode)) {
            $statusCode = 500;
        } else {
            $statusCode = (integer) base64_decode($statusCode);
        }

        $this->view->assign('statusCode', $statusCode);
        $this->view->assign('title', $statusCode . '_title');
        $this->view->assign('message', $statusCode . '_message');
        http_response_code($statusCode);
    }
}