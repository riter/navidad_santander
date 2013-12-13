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
        $photos = $this->Photo->find('all',array('order'=>array('Photo.id'=>'desc')));
        $this->set('photos', $photos);
    }

    public function admin_add()
    {
        $this->set('title_page', 'Admin - Adicionar Foto');
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
    public function ajax_reload_fotos($cantServer=0){
        $this->loadModel('Photo');
        $this->loadModel('Premio_cliente');
        $this->loadModel('Client');

        $res=array();
        $posiciones=array();

        $cantLocal=$this->Photo->find('count');

        CakeLog::debug(print_r($cantLocal,true));
        if($cantServer < $cantLocal){

            $photos = $this->Photo->find('all',array('order'=>array('Photo.id'=>'desc')));
            $ganadores = $this->Premio_cliente->find('all');


            foreach($ganadores as $ganador){
                $posiciones[]= $ganador['Premio']['posicion'];
            }

            $contador=0;
            $pos=0;
            $datosGanadores=array();
            while($contador < count($photos)){
                $photo=$photos[$contador];

                if($photo['Photo']['estado']!='2'){
                    $datos['id']=$photo['Photo']['id'];
                    $datos['src']=$photo['Photo']['nombre'];
                    $datos['cliente_id']=$photo['Photo']['cliente_id'];
                    $datos['cliente_nombre']=$photo['Client']['nombre'];


                    if(in_array($pos,$posiciones)){
                        $res[$pos]=array();
                        $val=array_search($pos,$posiciones);
                        unset($posiciones[$val]);
                        $pos++;
                        //CakeLog::debug(print_r('if1',true));
                    }else{
                        if(count($photo['Premio_cliente'])>0){
                            $datosGanadores[$datos['id']]=$datos;
                           // CakeLog::debug(print_r('if2',true));
                        }else{
                            $res[$pos]=$datos;
                            //CakeLog::debug(print_r('if3',true));
                            $pos++;
                        }
                        $contador++;
                    }
                    //CakeLog::debug(print_r($res,true));
                }
            }

            foreach($ganadores as $ganador){
                $id=$ganador['Photo']['id'];
                $pos=$ganador['Premio']['posicion'];
                $res[$pos]=$datosGanadores[$id];
            }
        }
        echo json_encode($res);
        $this->autoRender=false;
    }
} 