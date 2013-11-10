<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 11.08.13
 * Time: 16:24
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core\View\Helper;

/**
 * Class Pagination
 * @package RBMVC\Core\View\Helper
 */
class Pagination extends AbstractViewHelper {

    /**
     * @var array
     */
    private $indexParams = array();

    /**
     * @var Url
     */
    private $urlHelper;

    /**
     * @return array
     */
    public function getIndexParams() {
        return $this->indexParams;
    }

    /**
     * @param array $indexParams
     *
     * @return Pagination
     */
    public function setIndexParams(array $indexParams) {
        $this->indexParams = $indexParams;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function pagination() {
        $this->urlHelper = $this->view->getViewHelper('Url');

        $pages  = array();
        $number = ceil($this->indexParams['total'] / $this->indexParams['limit']);
        if ($number == 1) {
            return '';
        }

        $pages[] = $this->createPrev();
        for ($i = 1; $i <= $number; $i++) {
            $pages[] = $this->createLink($i);
        }
        $pages[] = $this->createNext($number);

        return $this->view->partial('layout/partials/pagination.phtml', array('pages' => $pages));
    }

    /**
     * @param int $page
     *
     * @return array
     */
    private function createLink($page) {
        return array(
            'label'     => $page,
            'url'       => $this->urlHelper->url(array('page' => $page), true),
            'is_active' => $page == $this->indexParams['page']
        );
    }

    /**
     * @param int $number
     *
     * @return array
     */
    private function createNext($number) {
        $next       = $this->indexParams['page'] + 1;
        $isDisabled = $next > $number;

        return array(
            'label'       => '&raquo;',
            'url'         => $this->urlHelper->url(array('page' => $next), true),
            'is_disabled' => $isDisabled,
            'is_active'   => false,
        );
    }

    /**
     * @return array
     */
    private function createPrev() {
        $prev       = $this->indexParams['page'] - 1;
        $isDisabled = $prev <= 0;

        return array(
            'label'       => '&laquo;',
            'url'         => $this->urlHelper->url(array('page' => $prev), true),
            'is_disabled' => $isDisabled,
            'is_active'   => false,
        );
    }

}