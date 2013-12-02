<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 06-08-13
 * Time: 10:15 PM
 * To change this template use File | Settings | File Templates.
 */

class ConsolaController extends AppController {

    public $components = array('Paginator');

    public function admin_index(){
        $this->set('title_page', 'Navidad Admin - Consola');
        $this->layout = 'backend';
    }
    public function mantenimiento(){
        $this->layout='';
    }
}