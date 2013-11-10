<?php
namespace RBMVC\Core\View\Helper;

/**
 * Class Url
 * @package RBMVC\Core\View\Helper
 */
class Url extends AbstractViewHelper {

    /**
     * @var boolean
     */
    private $useParams;

    /**
     * @param array $options
     * @param boolean $useParams
     *
     * @return string
     */
    public function url(array $options = array(), $useParams = false) {
        $this->useParams = $useParams;
        $urlParams       = array_merge($this->request->getGetParams(), $options);

        return $this->renderUrl($urlParams);
    }

    /**
     * @param array $urlParams
     *
     * @return string
     */
    private function renderUrl(array $urlParams) {
        $url = '/' . $urlParams['controller'] . '/' . $urlParams['action'];

        unset($urlParams['controller']);
        unset($urlParams['action']);

        if (empty($urlParams) || !$this->useParams) {
            return $url;
        }

        $url .= '?';
        foreach ($urlParams as $key => $value) {
            $url .= $key . '=' . $value . '&';
        }

        return $url;
    }
}