<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 29/10/13
 * Time: 12:00 PM
 */

class santanderHelper extends AppHelper{

    public function __constructor(){

    }
    public function getIconPremios(){
        $icons=array(
                'ipadmini.png'=>'Ipod mini',
                'ipodtouch.png'=>'Ipod touch',
                'ipod.png'=>'Ipod nano',
                'play_station.png'=>'Play Station',
                'psp.png'=>'PSP',
                'ipodnano.png'=>'Ipod nano',
                'ipodtouch_blue.png'=>'Ipod touch',
                'play_station_yellow.png'=>'Play Station',
                'ipadmini_yellow.png'=>'Ipod mini',
        );
        return $icons;
    }

    public function getTagHtml($id){
        $tag=array(
            'ipod.png'=>array('img'=>'ipodnano_azul','box'=>'box_azul','txt'=>'fazul'),
            'psp.png'=>array('img'=>'psp_amarillo','box'=>'box_amarillo','txt'=>'famarillo'),
            'play_station.png'=>array('img'=>'playstation_verde','box'=>'box_verde','txt'=>'fverde'),
            'ipodtouch.png'=>array('img'=>'ipodtouch_verde','box'=>'box_verde','txt'=>'fverde'),
            'ipadmini.png'=>array('img'=>'ipadmini_azul','box'=>'box_azul','txt'=>'fazul'),
            'play_station_yellow.png'=>array('img'=>'playstation_amarillo','box'=>'box_amarillo','txt'=>'famarillo'),
            'ipodnano.png'=>array('img'=>'ipodnano_verde','box'=>'box_verde','txt'=>'fverde'),
            'ipodtouch_blue.png'=>array('img'=>'ipodtouch_azul','box'=>'box_azul','txt'=>'fazul'),
            'ipadmini_yellow.png'=>array('img'=>'ipadmini_amarillo','box'=>'box_amarillo','txt'=>'famarillo')
        );
        return $tag[$id];
    }
    /*
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

    public function getImgPremios($id){
        $icons=array(
            '1'=>'ipadmini.png',
            '2'=>'ipodtouch.png',
            '3'=>'ipod.png',
            '4'=>'play_station.png',
            '5'=>'psp.png',
            '6'=>'ipodnano.png',
            '7'=>'ipodtouch_blue.png',
            '8'=>'play_station_yellow.png',
            '9'=>'ipadmini_yellow.png',
        );
        return $icons[$id];
    }*/

} 