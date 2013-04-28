<?php
namespace core\rbmvc\view\helper;

use core\rbmvc\view\helper\AbstractHelper;

class DateFormater extends AbstractHelper {
    
    public function dateFormater($date) {
        $dateMod = new \DateTime($date);
        return $dateMod->format('d. M. Y');
    }
    
}