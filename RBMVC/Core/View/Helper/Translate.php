<?php
namespace RBMVC\Core\View\Helper;

use RBMVC\Core\Translator;

class Translate extends AbstractHelper {
    
    /**
     * @var Translator 
     */
    private $translator;
    
    /**
     * @return void
     */
    public function __construct() {
        $this->translator = Translator::getInstance();
    }
    
    /**
     * @param string $key
     * @param string $lang
     * @return string
     */
    public function translate($key, $lang = null) {
       return $this->translator->translate($key, $lang); 
    }
}