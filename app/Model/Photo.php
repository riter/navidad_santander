<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Photo extends AppModel {
    public $name = 'Photo';
    var $useTable = 'foto';
    //var $displayField = 'descripcion';
    public $primaryKey = 'id';

    public $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'cliente_id'
        )
    );
} 