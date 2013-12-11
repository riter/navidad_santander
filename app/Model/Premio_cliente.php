<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Premio_cliente extends AppModel {
    public $name = 'Premio_cliente';
    var $useTable = 'premio_cliente';
    //var $displayField = 'descripcion';
    public $primaryKey = 'id';

    public $validate = array(
        'foto_id' => array(
            'rule'    => 'notEmpty'
        ),
        'premio_id' => array(
            'rule'    => array('notEmpty','isUnique')
        )
    );

    public $belongsTo = array(
        'Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'foto_id'
        ),
        'Premio' => array(
            'className' => 'Premio',
            'foreignKey' => 'premio_id'
        )
    );
} 