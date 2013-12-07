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
    public function admin_delete($id){

        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        try {
            $this->Photo->id=$id;
            $photo=$this->Photo->read();
            if ($this->Photo->delete($id, true)) {
                /*Para eliminar la imagen que referencia este id*/
                $file=substr($photo['Photo']['nombre'],1);
                if(is_file($file)){
                    unlink($file);
                }
                $this->Session->setFlash('La Foto con id: ' . $id . ' fue eliminada', 'success_message');
            }
        } catch (Exception $e) {
            $this->Session->setFlash('Error: No se puede eliminar la foto con id: ' . $id . ' porque tiene referencias', 'error_message');
        }
        $this->redirect(array('controller' => 'photos', 'action' => 'index'));
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

    /* Frontend: Devuelve lista de fotos para mostrar en la home */
    public function ajax_reload_fotos(){
        $this->loadModel('Photo');

        $res=array();
        $c=0;
        $photos = $this->Photo->find('all',array('order'=>array('Photo.id'=>'desc')));

        foreach($photos as $photo){
            if($photo['Photo']['estado']!='2'){
                $res[$c]['id']=$photo['Photo']['id'];
                $res[$c]['src']=$photo['Photo']['nombre'];
                $c++;
            }
        }
        echo json_encode($res);
        $this->autoRender=false;
    }
} 