<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class GanadoresController extends AppController
{
    public function admin_index()
    {
        $this->loadModel('Premio_cliente');

        $this->loadModel('Premio');
        $this->set('title_page', 'Admin - Ganadores');
        $this->layout = 'backend';

        $premios = $this->Premio->find('all');
        $this->set('premios', $premios);

        if($this->request->is('post') && isset($this->request->data['Premio_cliente'])){

            $datos=$this->request->data['Premio_cliente'];

            $saves=array();
            foreach($datos as $key=>$dato){
                $saves[]=array('Premio_cliente'=>array(
                                'foto_id'=>$dato,
                                'premio_id'=>$key
                            ));
            }

            if($this->Premio_cliente->saveAll($saves)){
                $this->Session->setFlash('Los ganadores fueron registrados', 'success_message');
                $this->redirect(array('action' => 'index'));
            }

        }
    }

} 