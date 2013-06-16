<?php
namespace RBMVC\Core\View\Helper;

class DateFormater extends AbstractHelper {
    
    /**
     * @param string $date
     * @return string
     */
    public function dateFormater($date) {
        $dateMod = new \DateTime($date);
        return $dateMod->format('d. M. Y');
    }
    
}