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
        //$photos = $this->Photo->find('all',array('order'=>array('Photo.id'=>'desc')));

        //$this->set('photos', $photos);
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

    public function ajax_reload_fotos($cantServer=0){
        $this->loadModel('Photo');
        $this->Photo->recursive=-1;
        $this->loadModel('Premio_cliente');
        $this->loadModel('Client');

        $res=array();

        $photos = $this->Photo->query("SELECT id,nombre,cliente_id FROM foto  WHERE estado != '2' AND id NOT IN (SELECT foto_id FROM premio_cliente) order by id desc");
        if($cantServer != count($photos)){

            /*Carga y reserva de posiciones de los ganadores*/
            $ganadores = $this->Premio_cliente->find('all');
            foreach($ganadores as $ganador){
                $pos=intval($ganador['Premio']['posicion']);

                $datos['id']=$ganador['Photo']['id'];
                $datos['src']=$ganador['Photo']['nombre'];
                $datos['cliente_id']=$ganador['Photo']['cliente_id'];
                //$datos['posicion']=$ganador['Premio']['posicion'];

                $res[$pos]=$datos;
            }
            //$photos = $this->Photo->query("SELECT * FROM foto  WHERE estado != '2' AND id NOT IN (SELECT foto_id FROM premio_cliente) order by id desc");
            $reservados=0;
            for($cont = 0; $cont<count($photos); $cont++){

                if(isset($res[$cont+$reservados])){
                    $reservados++;
                }

                $datos['id']=$photos[$cont]['foto']['id'];
                $datos['src']=$photos[$cont]['foto']['nombre'];
                $datos['cliente_id']=$photos[$cont]['foto']['cliente_id'];
                //$datos['posicion']=$cont+$reservados;

                $res[$cont+$reservados]= $datos;

            }
        }
        $res[]['cantidad']=count($photos);
        echo json_encode($res);
        $this->autoRender=false;
    }

    public function ajax_reload_fotos_admin($cantServer=0){
        $this->loadModel('Photo');
        $this->Photo->recursive=-1;
        $this->loadModel('Premio_cliente');
        $this->loadModel('Client');

        $res=array();

        $photos = $this->Photo->query("SELECT foto.id,foto.nombre,foto.cliente_id,cliente.nombre FROM foto, cliente  WHERE foto.estado != '2' AND foto.id NOT IN (SELECT foto_id FROM premio_cliente) AND foto.cliente_id = cliente.id ORDER BY foto.id DESC");
        if($cantServer != count($photos)){

            /*Carga y reserva de posiciones de los ganadores*/
            $ganadores = $this->Premio_cliente->find('all');
            foreach($ganadores as $ganador){
                $pos=intval($ganador['Premio']['posicion']);

                $datos['id']=$ganador['Photo']['id'];
                $datos['src']=$ganador['Photo']['nombre'];
                $datos['cliente_id']=$ganador['Photo']['cliente_id'];
                $res[$pos]=$datos;
            }

            $reservados=0;
            $cont=0;
            foreach($photos as $photo){
                $datos['id']=$photo['foto']['id'];
                $datos['src']=$photo['foto']['nombre'];
                $datos['cliente_id']=$photo['foto']['cliente_id'];
                $datos['cliente_nombre']=$photo['cliente']['nombre'];

                if(isset($res[$cont+$reservados])){
                    $photo_ganador=$this->Client->query("SELECT nombre FROM cliente WHERE id = ".$res[$cont+$reservados]['cliente_id']);

                    //$res[$cont+$reservados]=$datos;
                    $res[$cont+$reservados]['cliente_nombre']=$photo_ganador[0]['cliente']['nombre'];
                    $reservados++;
                }

                $res[$cont+$reservados]= $datos;
                $cont++;
            }
        }
        $res[]['cantidad']=count($photos);
        echo json_encode($res);
        $this->autoRender=false;
    }
    /* Carga del admin index por ajax*/
    public function admin_lista_fotos()
    {
        $this->layout = 'ajax';

        $datos = $this->request->query;
        //Variable de datatable
        $this->set('sEcho', $datos['sEcho']);

        //Filtro default
        $condition = array(
            'Photo.cliente_id = Client.id', 'NOT' => array('Client.id' => null));

        //Total sin filtro
        $iTotal = $this->Photo->find('count');
        $this->set('iTotal', $iTotal);

        $fields = array(
            'Photo.id',
            'Photo.nombre',
            'Photo.fecha',
            'Photo.estado'
        );
        //Filtro dataTable
        if ($datos['sSearch'] != '') {
            foreach ($fields as $key => $field) {
                if ($datos['bSearchable_' . $key] == 'true') {
                    $conditionLike["$field LIKE "] = "%{$datos['sSearch']}%";
                }
            }
            $condition['OR'] = $conditionLike;
        }

        //Total con filtro
        $iFilteredTotal = $this->Photo->find('count');
        $this->set('iFilteredTotal', $iFilteredTotal);

        //Ordenacion de columnas
        $orderColumn = $datos['iSortCol_0'];
        $orderDir = $datos['sSortDir_0'];
        $orderSQL = array($fields[$orderColumn] => $orderDir);

        //Datos
        $listaMembers = $this->Photo->find('all', array('conditions' => $condition,
            'order' => $orderSQL,
            'limit' => $datos['iDisplayLength'],
            'offset' => $datos['iDisplayStart']));

        //CakeLog::debug(print_r($listaMembers,true));
        $this->set('photos', $listaMembers);
    }
} 