<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 01.02.14
 * Time: 01:13
 */

namespace RBMVC\Core\Utilities\Form\Decorators;


use Application\Lib\Model\Language;
use RBMVC\Core\Utilities\Form\Elements\AbstractElement;

/**
 * Class I81N
 * @package RBMVC\Core\Utilities\Form\Decorators
 */
class I81N extends AbstractDecorator {

    /**
     * @var Language[]
     */
    protected $languages = array();

    /**
     * @param string $template
     *
     * @return string
     */
    public function render($template = '') {

        $out = $this->renderHead();

        $out .= '<div class="tab-content">';

        $elements = $this->getElements();
        foreach ($this->languages as $key => $language) {
                $out .= '<div class="tab-pane ' . ($key == 0 ? ' active' : '') . '" id="i81n_' . $language->getCode() . '">';
            foreach ($elements[$language->getId()] as $element) {
                /** @var AbstractElement $element */
                $out .= $element->render();
            }

            $out .= '</div>';
        }
        $out .= '</div>';

        return $out;

    }

    /**
     * @param Language[] $languages
     *
     * @return I81N
     */
    public function setLanguages($languages) {
        $this->languages = $languages;

        return $this;
    }

    /**
     * @return Language[]
     *
     * @return string
     */
    public function getLanguages() {
        return $this->languages;
    }

    private function renderHead() {
        $html = '<ul class="nav nav-tabs">';

        foreach ($this->languages as $key => $language) {
            $html .= '<li ' . ($key == 0 ? 'class="active"' : '') . '><a href="#i81n_' . $language->getCode()
                . '" data-toggle="tab">' . strtoupper($language->getCode()) . '</a></li>';
        }

        $html .= '</ul>';
        return $html;
    }

}