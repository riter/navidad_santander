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
        $this->loadModel('Premio_client');

        if ($this->request->is('post')) {
            $datos = $this->request->data;
            $datos['Client']['uid_facebook']=$this->Session->read('idFacebook');
            $newClient=$this->Client->save($datos);
            if ($newClient) {

                $this->redirect(array('controller' => 'Home', 'action' => 'home'));
            }
        }
    }

    public function upload_completed(){
        $this->layout='';
    }
    public function upload(){
        try{
            $this->layout='';

            if ($this->request->is('post')) {

                $cropX = $this->request->data['cropX'];
                $cropY = $this->request->data['cropY'];
                $cropW = $this->request->data['cropW'];
                $cropH = $this->request->data['cropH'];
                $imgH = $this->request->data['imgH'];

                $size = (int) $_SERVER['CONTENT_LENGTH'];
                if( isset($_FILES['file']) && ($size < (5 * 1024 * 1024))){

                    if ($_FILES["file"]["error"] > 0){
                        $output = "Return Code: " . $_FILES["file"]["error"];
                        echo ("<script>alert('$output')</script>");
                    }else{
                        $extension = explode('/',$_FILES["file"]["type"]);
                        $extension = $extension[1];
                        //$extension = 'jpeg';
                        $filename=uniqid("user2_");
                        if(move_uploaded_file($_FILES["file"]["tmp_name"],
                            'fotos/'.$filename.'.'.$extension)){

                            $this->_resize('fotos/'.$filename.'.'.$extension,$cropX,$cropY,$cropW,$cropH,$extension,$imgH);

                            if($this->saveFoto('/fotos/'.$filename.'.'.$extension)){
                                $this->publicarFacebook();
                                $this->redirect(array('action'=>'sended'));
                            }
                        }
                    }

                }else{
                    echo("<script> alert('Error: Tamaño del Acrvhivo exede el limite')</script>");
                }
            }
        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage()));
        }
    }

    public function saveFoto($filename){
        $this->loadModel('Client');
        $this->loadModel('Photo');

        $cliente=$this->Client->find('first',array('conditions'=>array('uid_facebook'=>$this->Session->read('idFacebook'))));
        $photo=array('Photo'=>array(
            'nombre'=>$filename,
            'estado'=>'0',
            'fecha'=>date("Y-m-d"),
            'cliente_id'=>$cliente['Client']['id']
        ));
        if($this->Photo->save($photo)){
            return true;
        }
        return false;
    }

    public function _resize($filename=null,$cropX,$cropY,$cropW,$cropH,$ext=null,$imgH){
        try{
            $jpeg_quelity=100;
            list($targ_w,$targ_h)=getimagesize($filename);

            /*if($targ_w<=$cropW){
                $cropW=$targ_w;
            }
            if($targ_h<=$cropH){
                $cropH=$targ_h;
            }*/
            switch($ext){
                case 'gif':
                    $img_r=imagecreatefromgif($filename);
                    break;
                case 'png':
                    $img_r=imagecreatefrompng($filename);
                    break;
                case 'jpeg':
                    $img_r=imagecreatefromjpeg($filename);
                    break;
                case 'jpg':
                    $img_r=imagecreatefromjpeg($filename);
                    break;
            }
            $cropW=round($cropW);
            $cropH=round($cropH);
            $dist_r= imagecreatetruecolor($cropW,$cropH);

            $newcropY=($cropY*$targ_h)/$imgH;
            $newtarg_h=((($cropY+$cropH)*$targ_h)/$imgH)-$newcropY;
            $newcropY=round($newcropY);
            $newtarg_h=round($newtarg_h);
            imagecopyresampled($dist_r,$img_r,0,0,0,$newcropY,$cropW,$cropH,$targ_w,$newtarg_h);

            header('Contend-type: image/'.$ext);
            switch($ext){
                case 'gif':
                    imagegif($dist_r,$filename);
                    break;
                case 'png':
                    imagepng($dist_r,$filename);
                    break;
                case 'jpeg':
                    imagejpeg($dist_r,$filename,$jpeg_quelity);
                    break;
                case 'jpg':
                    imagejpeg($dist_r,$filename,$jpeg_quelity);
                    break;
            }
        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage()));
        }

    }

    public function ajax_saveImg(){
        Header("Content-type: image/png");

        try{
            $srcCadena=$this->request->data['src'];

            $filename=uniqid("user2_");
            $filename='fotos/'.$filename.'.png';

            $dataURL = str_replace('data:image/png;base64,', '', $srcCadena);
            $dataURL = str_replace(' ', ',', $dataURL);
            $image = base64_decode($dataURL);

            file_put_contents($filename, $image);

            if($this->saveFoto('/'.$filename)){
                $this->publicarFacebook();
                $res = '/registers/sended';
            }else{
                $res = 'Error';
            }

        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage(),true));
            $res = 'Error';
        }

        echo $res;
        $this->autoRender = false;
    }

    public function publicarFacebook(){
        try{
            $facebook=new Facebook($this->getConfigFacebook());

            $ret_obj = $facebook->api('/me/feed', 'POST',array(
                'link' => Router::url('/',true),
                'message' => 'Yo lo quiero para Navidad','description' => 'Participa ahora!. Sube tus fotos y desplaza a los demas para colocar tu foto en el cuadro con premio.',
                'picture'=>Router::url('/',true).'/frontend_images/logo.png',
                'privacy' => array('value' => 'EVERYONE')));

        }catch (Exception $e){
            CakeLog::debug(print_r($e->getMessage(),true));
        }
    }

    public function sended(){
        $this->layout='';
        if($this->request->is('post')){
            $this->redirect('https://www.facebook.com/dialog/apprequests?app_id=559917344092598&message=Participa%20ahora!.%20En%20el%20concurso%20Yo%20lo%20quiero%20para%20Navidad&display=popup&redirect_uri=http://test.navidad.com/home/home');
        }else{
            $config=$this->getConfigFacebook();
            $this->set('appId',$config['appId']);
        }
    }
    public function ajax_Upload(){
        $this->loadModel('Client');
        $this->loadModel('Photo');

        $res='upload_false';

        $cliente = $this->Client->find('first',array('conditions'=>array('uid_facebook'=>$this->Session->read('idFacebook'))));
        if(!empty($cliente)){

            $photo=$this->Photo->find('all',array('conditions'=>array('fecha'=>date("Y-m-d"),'cliente_id'=>$cliente['Client']['id'])));

            if(count($photo)<3){
                $res = 'upload_true';
            }

        }

        echo $res;
        $this->autoRender = false;
    }

} 