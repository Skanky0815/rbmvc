<?php
namespace RBMVC\Core;

class Translator {
    
    /**
     * @var Translator 
     */
    private static $instance;
    
    /**
     * @var string
     */
    private $lang;
    
    /**
     * @var array
     */
    private $texts;
    
    /**
     * @return Translator
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Translator();
        }
        return self::$instance;
    }
    
    /**
     * @return void
     */
    private function __construct() {
        $this->texts = array();
    }
    
    /**
     * @param array $options
     * @return void
     */
    public function init(array $options) {
        if (key_exists('default_language', $options)) {
            $this->lang = $options['default_language'];
        }
    }
    
    /**
     * @param string $lang
     * @return void 
     */
    public function setLang($lang) {
        $this->lang = $lang;
    }
    
    /**
     * @param string $key
     * @param string $lang
     * @return string
     */
    public function translate($key, $lang = '') {
        if (empty($lang)) {
            $lang = $this->lang;
        }
        
        $this->loadTranslationFile($lang);
        
        if (key_exists($lang, $this->texts) 
                && key_exists($key, $this->texts[$lang])) {
            return $this->texts[$lang][$key];
        } 
        
        return $key;
    }
    
    /**
     * @param string $lang
     * @return void
     */
    private function loadTranslationFile($lang) {
        if (key_exists($lang, $this->texts)) {
            return;
        } 
        
        $path = APPLICATION_DIR . 'data/translations/' . $lang . '.ini';
        if (file_exists($path)) {
            $this->texts[$lang] = parse_ini_file($path);
        } else {
            error_log(__METHOD__.'::> No translation file found.');
            $this->texts[$lang] = array();
        }
    }
}