<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 3/12/13
 * Time: 11:22 AM
 */

class RegistersController extends AppController{

    public function index(){
        $this->layout='';
        $this->loadModel('Client');
        if ($this->request->is('post')) {
            $datos = $this->request->data;
            $datos['Client']['uid_facebook']=$this->Session->read('idFacebook');
            if ($this->Client->save($datos)) {
                $this->redirect(array('controller' => 'Home', 'action' => 'home'));
            }
        }
    }

    public function upload(){
        $this->layout='';
        $this->loadModel('Photo');

        if ($this->request->is('post')) {

            $size = (int) $_SERVER['CONTENT_LENGTH'];
            if( isset($_FILES['file']) && ($size < (2 * 1024 * 1024))){

                if ($_FILES["file"]["error"] > 0){
                    $output = "Return Code: " . $_FILES["file"]["error"];
                    echo ("<script>alert('$output')</script>");
                }else{
                    $extension = explode('/',$_FILES["file"]["type"])[1];
                    $filename=uniqid("user2_");
                    if(move_uploaded_file($_FILES["file"]["tmp_name"],
                        'fotos/'.$filename.'.'.$extension)){

                        $this->_resize('fotos/'.$filename.'.'.$extension,205,205,$extension);
                        $photo=array('Photo'=>array(
                            'nombre'=>'/fotos/'.$filename.'.'.$extension,
                            'estado'=>'0',
                            'fecha'=>date("Y-m-d H:i:s"),
                            'cliente_id'=>'2'
                        ));
                        if($this->Photo->save($photo)){
                            $this->redirect(array('action'=>'sended'));
                        }
                    }
                }

            }else{
                echo("<script> alert('Error: Tamaño del Acrvhi exede el limite')</script>");
            }
        }
    }
    public function _resize($filename=null,$ancho=null,$alto=null,$ext=null){

        $jpeg_quelity=100;
        list($targ_w,$targ_h)=getimagesize($filename);

        if($targ_w<=$ancho){
            $ancho=$targ_w;
        }
        if($targ_h<=$alto){
            $alto=$targ_h;
        }

        $img_r=imagecreatefromjpeg($filename);
        $dist_r= imagecreatetruecolor($ancho,$alto);

        imagecopyresampled($dist_r,$img_r,0,0,0,0,$targ_w,$targ_h,$ancho,$alto);

        header('Contend-type: image/'.$ext);
        imagejpeg($dist_r,$filename,$jpeg_quelity);
    }

    public function publicarFacebook(){
        try{
            $facebook=new Facebook($this->getConfigFacebook());

            $ret_obj = $facebook->api('/me/feed', 'POST',array(
                'link' => Router::url('/',true),
                'message' => 'Yo lo quiero para Navidad','description' => 'Participa ahora!. Sube tus fotos y desplaza a los demas para colocar tu foto en el cuadro con premio',
                'picture'=>Router::url('/',true).'/frontend_images/logo.png',
                'privacy' => array('value' => 'EVERYONE')));
        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage(),true));
        }
    }

    public function sended(){
        $this->layout='';
    }
} 