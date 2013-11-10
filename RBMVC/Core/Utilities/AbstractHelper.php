<?php
namespace RBMVC\Core\Utilities;

use RBMVC\Core\Request;
use RBMVC\Core\View\View;

/**
 * Class AbstractHelper
 * @package RBMVC\Core\Utilities
 */
abstract class AbstractHelper {

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param array $config
     *
     * @return AbstractHelper
     */
    public function setConfig(array $config) {
        $this->config = $config;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return AbstractHelper
     */
    public function setRequest(Request $request) {
        $this->request = $request;

        return $this;
    }

    /**
     * @param View $view
     *
     * @return AbstractHelper
     */
    public function setView(View &$view) {
        $this->view = $view;

        return $this;
    }

}