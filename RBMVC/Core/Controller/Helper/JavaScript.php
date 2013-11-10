<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 02.11.13
 * Time: 02:55
 */

namespace RBMVC\Core\Controller\Helper;

use RBMVC\Core\Utilities\FileHandle;
use RBMVC\Core\Utilities\JavaScriptList;

/**
 * Class JavaScript
 * @package RBMVC\Core\Controller\Helper
 */
class JavaScript extends AbstractActionHelper {

    /**
     * @var FileHandle
     */
    private $fileHandle = null;

    function __construct() {
        $this->fileHandle = new FileHandle();
    }

    /**
     * @return array|string
     */
    public function javaScript() {
        $hasJsCache = $this->request->getParam('cache', $this->config['cache']['javascript']);
        $controller = $this->request->getParam('c');
        $action     = $this->request->getParam('a');

        $js         = '';
        $jsFileName = $controller . '_' . $action . '.js';
        if ($jsFileName == '_.js') {
            return '';
        }

        if ($this->fileHandle->existsFile(APPLICATION_DIR . 'data/temp/js/' . $jsFileName)) {
            $js = file_get_contents(APPLICATION_DIR . 'data/temp/js/' . $jsFileName);
        } else {

            $js = array();
            if ($this->fileHandle->existsFile(ROOT_DIR . 'public/js/lib/jquery-2.0.3.min.js')) {
                $js[] = file_get_contents(ROOT_DIR . 'public/js/lib/jquery-2.0.3.min.js', false);
            }
            if ($this->fileHandle->existsFile(ROOT_DIR . 'public/js/lib/bootstrap.min.js')) {
                $js[] = file_get_contents(ROOT_DIR . 'public/js/lib/bootstrap.min.js', false);
            }

            foreach (JavaScriptList::getInstance()->getList() as $javaScript) {
                if ($this->fileHandle->existsFile($javaScript)) {
                    $js[] = file_get_contents($javaScript, false);
                }
            }

            $js = implode("\r\n\r\n", $js);
            if ($hasJsCache) {
                $this->fileHandle->createFile(APPLICATION_DIR . 'data/temp/js/' . $jsFileName, $js);
            }
        }

        return $js;
    }

}