<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class PhotosController extends AppController
{
    public function admin_index()
    {
        $this->set('title_page', 'Admin - Fotos');
        $this->layout = 'backend';
        $photos = $this->Photo->find('all');
        $this->set('photos', $photos);
    }

    public function admin_add()
    {
        $this->set('title_page', 'Admin - Adicionar Usuario');
        $this->layout = 'backend';
        if ($this->request->is('post')) {
            $datos = $this->request->data;
            if ($this->Premio->save($datos)) {
                $this->Session->setFlash('Su Premio fue registrada', 'success_message');
                $this->redirect(array('controller' => 'premios', 'action' => 'index'));
            }
        }
    }
    public function admin_ver($id = null){
        $this->layout='';
        $this->Photo->id = $id;
        $photo = $this->Photo->read();

        $this->set('img',$photo['Photo']['nombre']);
        $this->set('id',$photo['Photo']['id']);
    }
    public function admin_moderar($id=null, $estado=null){
        $this->layout='';
        $this->Photo->id = $id;
        $photo = $this->Photo->read();
        $photo['Photo']['estado']=$estado;
        if ($this->Photo->save($photo)) {
            $this->Session->setFlash('Se actualizo el estado', 'success_message');
        }else{
            $this->Session->setFlash('Error: No se pudo cambiar el estado intente nuevamente', 'error_message');
        }
        $this->redirect(array('controller' => 'photos', 'action' => 'index'));
    }
} 