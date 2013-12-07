<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 3/12/13
 * Time: 11:22 AM
 */

class HomeController extends AppController{

    public function index(){
        $this->layout='';
    }

    public function home(){
        $this->layout='';

        /* validar si son menos de cincuenta inscritos mosrtrar imagen 50 Premios*/
        $this->loadModel('Client');
        $clientes = $this->Client->find('all',array('order'=>array('Client.id'=>'asc'),'limit'=>'51'));

        if( count($clientes)<51){
            $this->set('primerosCinc',true);
        }
    }
    public function getPopup(){
        $this->loadModel('Client');

        $res='';
        if($this->Session->check('likeFacebook')
            && $this->Session->read('likeFacebook')){

            if($this->Session->check('idFacebook')){
                $cliente = $this->Client->find('first',array('conditions'=>array('uid_facebook'=>$this->Session->read('idFacebook'))));

                if(empty($cliente)){
                    $res= 'registro';
                }
            }
        }else{
            $res= 'like';
        }

        echo $res;
        $this->autoRender=false;
    }

    public function like(){
        $this->layout='';
    }
} 