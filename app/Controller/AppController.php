<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

require_once("facebook/facebook.php");

session_start();
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $ext = '.php';
    public $like=false;

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'clients', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authorize' => array('Controller')
        )
    );

    public function beforeFilter() {

        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            $this->Auth->deny();
        } else {
            $this->Auth->allow();
        }
        //$this->Session->write('idFacebook','100006874081297');
        //$this->Session->write('likeFacebook',true);

        //control para ingresar solo si esta en TabFacebook y con like
        $facebook=new Facebook($this->getConfigFacebook());
        $signed_request = $facebook->getSignedRequest();
        $user=$facebook->getUser();

        if(isset($signed_request["page"]["id"])){
            $canvas_page = $this->getUrlATab();
        }else{
            $canvas_page = $this->getUrlApp();
        }

        $auth_url = "https://www.facebook.com/dialog/oauth?client_id=".$facebook->getAppId()
            ."&scope=email,user_likes,publish_stream&redirect_uri=" . urlencode($canvas_page);

        try{
            if(isset($this->request->data['signed_request'])){

                if(isset($signed_request["page"]["id"])){

                    $this->like=$signed_request["page"]["liked"];
                    if($this->like){
                        $canvas_page = $this->getUrlApp();
                        echo("<script> top.location.href='" .$canvas_page. "'</script>");
                    }

                }elseif( $user){
                        $this->Session->write('idFacebook',$user);

                        /*Validar like por Grapho*/
                        /*$graph_url = "/me/likes?access_token=". $facebook->getAccessToken();
                        $likes=$facebook->api($graph_url);
                        $this->like=$this->haveLike($likes);
                        */
                        /*  Validar like por Query*/
                        /*$user_graph = $facebook->api(array(
                            'method'=>'fql.query',
                            'query'=>"SELECT page_id FROM page_fan WHERE uid=me()"
                        ));
                        $this->like=$this->validarLikeQuery($user_graph);
                        */
                        $graph_url = "/me/likes/".$this->getIdLike()."?access_token=". $facebook->getAccessToken();
                        $likes=$facebook->api($graph_url);
                        $newLike=isset($likes['data']) && count($likes['data']);
                        if(($this->Session->check('likeFacebook') && !$this->Session->read('likeFacebook')) || $newLike){
                            $this->like=$newLike;
                        }
                    }else{
                        // esta en la web y redirect a TabFacebook
                        echo("<script> top.location.href='" .$auth_url. "'</script>");
                    }
                $this->Session->write('likeFacebook',$this->like);
            }

        }catch (Exception $e){
          echo("<script> top.location.href='" .$auth_url. "'</script>");
        }
    }

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
        // Default deny
        return false;
    }

    //***********  Mi Metodos de Ayuda
    public  function getConfigFacebook() {
        /* Configuracion de el AppFacebook cambiar el appId y secret por los codigos que proporsiona Facebook*/
        $config = array('appId' => '559917344092598','secret'=>'6d7ec7106bca1dcc0765bd9c226b5ad3',
            'fileUpload' => false, 'cookie' => true);

        /* Codigos de Prueba en modo testing*/
        /*$config = array('appId' => '771893319494562','secret'=>'b64a0254bd94949c1efb533797c893fa',
            'fileUpload' => false, 'cookie' => true);*/

        return $config;
    }

    public  function getUrlApp() {
        /* Cambiar la direccion por la direccion de la app que proporsiona Facebook*/
        $direccionAppFacebook='https://apps.facebook.com/testnavidad';
        return $direccionAppFacebook;

        /* Direccion de Prueba en modo testing*/
        //return 'http://apps.facebook.com/testmobiletwo';
    }
    public  function getUrlATab() {

        /* Cambiar la direccion por la direccion de la app que proporsiona Facebook*/
        $direccionTabFacebook='http://www.facebook.com/unileverweb/app_559917344092598';
        return $direccionTabFacebook;

        /* Direccion de Prueba en modo testing*/
        //return 'http://www.facebook.com/unileverweb/app_771893319494562';
    }

    public function getIdLike(){
        /*Cambiar por el codigo de la FanPage que desean utilizar*/
        $codigoFanPage='519504951472584';
        return $codigoFanPage;
    }
    public function haveLike($fb_response){

        foreach ($fb_response['data'] as $like => $valor){

            if(array_search($this->getIdLike(), $valor))
                return true;
        }
        return false;
    }
    public function validarLikeQuery($user_graph){

        foreach($user_graph as $pag_id){
            if($pag_id['page_id']==$this->getIdLike()){
                return true;
            }
        }
        return false;
    }
}
