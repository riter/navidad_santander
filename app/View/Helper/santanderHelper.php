<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 29/10/13
 * Time: 12:00 PM
 */

class santanderHelper extends AppHelper{

    public function getIconPremios(){
        $icons=array(
                '1'=>'Ipod mini',
                '2'=>'Ipod touch',
                '3'=>'Ipod nano',
                '4'=>'Play Station',
                '5'=>'PSD',
                '6'=>'Ipod nano',
                '7'=>'Ipod touch',
                '8'=>'Play Station',
                '9'=>'Ipod mini',
        );
        return $icons;
    }
} 