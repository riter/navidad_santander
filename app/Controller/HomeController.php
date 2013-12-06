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
    public function ajax_reload_fotos(){
        $this->loadModel('Photo');

        $res=array();
        $c=0;
        $photos = $this->Photo->find('all',array('order'=>array('Photo.id'=>'desc'),array('top'=>'55')));
        // $countrys = $this->Member>find('list', array('order' => array('Country.c_description' => 'asc')));

        foreach($photos as $photo){
            if($photo['Photo']['estado']!='2'){
                $res[$c]['src']=$photo['Photo']['nombre'];
                $c++;
            }
        }
        echo json_encode($res);
        $this->autoRender=false;
    }
    public function like(){
        $this->layout='';
    }
} 