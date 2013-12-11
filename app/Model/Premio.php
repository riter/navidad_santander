<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Premio extends AppModel {
    public $name = 'Premio';
    var $useTable = 'premio';
    //var $displayField = 'descripcion';
    public $primaryKey = 'id';

    public $hasMany = array(
        'Premio_cliente' => array(
            'className' => 'Premio_cliente',
            'foreignKey' => 'premio_id'
        )
    );
} 