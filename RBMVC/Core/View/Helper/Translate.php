<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Translator;

/**
 * Class Translate
 * @package RBMVC\Core\View\Helper
 */
class Translate extends AbstractViewHelper {

    /**
     * @var Translator
     */
    private $translator;

    public function __construct() {
        $this->translator = Translator::getInstance();
    }

    /**
     * @param string $key
     * @param string $lang
     *
     * @return string
     */
    public function translate($key, $lang = null) {
        return $this->translator->translate($key, $lang);
    }
}