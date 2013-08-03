<?php
namespace Application\ViewHelper;

use RBMVC\Core\View\Helper\AbstractViewHelper;

class DateFormater extends AbstractViewHelper {
    
    /**
     * @param string $date
     * @return string
     */
    public function dateFormater($date) {
        $dateMod = new \DateTime($date);
        return $dateMod->format('d. M. Y');
    }
    
}