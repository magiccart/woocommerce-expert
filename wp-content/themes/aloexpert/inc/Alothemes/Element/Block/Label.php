<?php
/**
 * Magiccart 
 * @category    Magiccart 
 * @copyright   Copyright (c) 2014 Magiccart (http://www.magiccart.net/) 
 * @license     http://www.magiccart.net/license-agreement.html
 * @Author: DOng NGuyen<nguyen@dvn.com>
 * @@Create Date: 2018-05-17 10:22:36
 * @@Modify Date: 2018-08-07 11:52:49
 * @@Function:
 */

namespace Alothemes\Element\Block;

class Label extends Template{

    public function _nowIsBetween($fromDate, $toDate)
    {
        if ($fromDate){
            // $fromDate = strtotime($fromDate);
            // $toDate = strtotime($toDate);
            $now = strtotime(date("Y-m-d H:i:s"));
            
            if ($toDate){
                if ($fromDate <= $now && $now <= $toDate) return true;
            }else {
                if ($fromDate <= $now) return true;
            }
        }
        return false;
    }

}

