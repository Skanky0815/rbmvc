<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 27.01.14
 * Time: 09:47
 */

namespace Application\Controller;

use Application\Lib\Controller\AbstractRudiController;

/**
 * Class LanguageController
 * @package Application\Controller
 */
class LanguageController extends AbstractRudiController {

    public function __construct() {
        parent::__construct('Language');
    }

} 