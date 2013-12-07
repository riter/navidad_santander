<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */
App::uses('Helper', 'View');
class PremiosController extends AppController
{
    //public $helpers  = array('santander');

    public function admin_index()
    {
        $this->set('title_page', 'Admin - Premios');
        $this->layout = 'backend';
        $premios = $this->Premio->find('all');
        $this->set('premios', $premios);
    }

    public function admin_add()
    {
        $this->set('title_page', 'Admin - Adicionar Usuario');
        $this->layout = 'backend';
        if ($this->request->is('post')) {
            $this->request->data['Premio']['posicion']=($this->request->data['Premio']['posicion'] - 1);
            $datos = $this->request->data;
            if ($this->Premio->save($datos)) {
                $this->Session->setFlash('Su Premio fue registrada', 'success_message');
                $this->redirect(array('controller' => 'premios', 'action' => 'index'));
            }
        }
    }

    public function admin_edit($id = null)
    {
        $this->set('title_page', 'Admin - Editar Premio');
        $this->layout = 'backend';
        $this->Premio->id = $id;
        if ($this->request->is('get')) {
            $Usuario = $this->Premio->read();
            $this->request->data = $Usuario;
            $this->render('admin_add');
        } else {
            $this->request->data['Premio']['posicion']=($this->request->data['Premio']['posicion'] - 1);
            $datos = $this->request->data;
            if ($this->Premio->save($datos)) {
                $this->Session->setFlash('Su Premio fue actualizada', 'success_message');
                $this->redirect(array('controller' => 'premios', 'action' => 'index'));
            }
        }
    }

    public function admin_delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        try {
            if ($this->Premio->delete($id, true)) {
                $this->Session->setFlash('El Premio con id: ' . $id . ' fue eliminada', 'success_message');
            }
        } catch (Exception $e) {
            $this->Session->setFlash('Error: No se puede eliminar el Premio con id: ' . $id . ' porque tiene referencias', 'error_message');
        }
        $this->redirect(array('controller' => 'premios', 'action' => 'index'));
    }

    public function getListaPremios(){
        //App::import('Helper', 'santander');
        //$helper=new santanderHelper(new View());

        $res=array();
        $premios = $this->Premio->find('all');
        $c=0;
        foreach($premios as $premio){
            $res[$c]['descripcion']=$premio['Premio']['descripcion'];
            $res[$c]['posicion']=$premio['Premio']['posicion'];
            $res[$c]['imagen']=$premio['Premio']['imagen'];
            $res[$c]['html']=$this->getTagHtml($premio['Premio']['imagen']);
            $c++;
        }

        echo json_encode($res);
        $this->autoRender=false;
    }
    public function getTagHtml($id){
        $tag=array(
            'ipod.png'=>array('img'=>'ipodnano_azul','box'=>'box_azul','txt'=>'fazul'),
            'psp.png'=>array('img'=>'psp_amarillo','box'=>'box_amarillo','txt'=>'famarillo'),
            'play_station.png'=>array('img'=>'playstation_verde','box'=>'box_verde','txt'=>'fverde'),
            'ipodtouch.png'=>array('img'=>'ipodtouch_verde','box'=>'box_verde','txt'=>'fverde'),
            'ipadmini.png'=>array('img'=>'ipadmini_azul','box'=>'box_azul','txt'=>'fazul'),
            'play_station_yellow.png'=>array('img'=>'playstation_amarillo','box'=>'box_amarillo','txt'=>'famarillo'),
            'ipodnano.png'=>array('img'=>'ipodnano_verde','box'=>'box_verde','txt'=>'fverde'),
            'ipodtouch_blue.png'=>array('img'=>'ipodtouch_azul','box'=>'box_azul','txt'=>'fazul'),
            'ipadmini_yellow.png'=>array('img'=>'ipadmini_amarillo','box'=>'box_amarillo','txt'=>'famarillo')
        );
        return $tag[$id];
    }

} 