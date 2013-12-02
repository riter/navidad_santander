<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 30/10/13
 * Time: 09:43 AM
 */

class UsersController extends AppController{

    /*public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }*/

    public function admin_index() {
        $this->set('title_page','Unicef Admin - Usuarios');
        $this->layout='backend';

        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all'));
    }
    public function admin_add() {
        $this->set('title_page','Unicef Admin - Adicionar Usuario');
        $this->layout='backend';

        if($this->request->is('post')){
            $this->User->create();

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('El usuario fue creado', 'default', array('class' => 'da-message success'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function admin_edit($id) {
        $this->set('title_page','Unicef Admin - Adicionar Usuario');
        $this->layout='backend';
        $this->User->id=$id;

        if($this->request->is('get')){
            $this->request->data=$this->User->read();
            $this->render('admin_add');
        }else{

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('El usuario fue actualizado', 'default', array('class' => 'da-message success'));
                return $this->redirect(array('action' => 'index'));
            }

        }
    }

    public function admin_delete($id=null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }

        if($this->User->delete($id)){
            $this->Session->setFlash('El usuario con id: ' . $id . ' fue eliminado', 'default', array('class' => 'da-message success'));
            $this->redirect(array('action' => 'index'));
        }
    }
    public function admin_login() {
        $this->layout='';
        $this->set('title_page','Unicef Admin - Login');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Your username or password was incorrect.'));
        }
    }

    public function admin_logout() {
        return $this->redirect($this->Auth->logout());
    }

} 