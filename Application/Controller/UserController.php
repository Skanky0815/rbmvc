<?php
namespace Application\Controller;

class UserController extends AbstractRudiController {

    public function __construct() {
        parent::__construct('user');
    }

    /**
     * @return void
     */
    public function registrationAction() {
        if (!$this->request->isPost()) {
            return;
        }

        $params = $this->request->getParams();
        if ($params['password'] != $params['password2']) {

        }
    }

}