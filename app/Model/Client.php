<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class Client extends AppModel {
    public $name = 'Client';
    var $useTable = 'cliente';
    //var $displayField = 'descripcion';
    public $primaryKey = 'id';
} 