<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 30/10/13
 * Time: 10:21 AM
 */

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
    var $useTable = 'users';
    //public $displayField = 'username';
    public $primaryKey = 'id';

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}