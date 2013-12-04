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

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'consola', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authorize' => array('Controller') // Added this line
        )
    );

    public function beforeFilter() {

        if (isset($this->params['prefix']) && $this->params['prefix'] == 'admin') {
            $this->Auth->deny();
        } else {
            $this->Auth->allow();
        }
        //control para ingresar solo si esta en TabFacebook y con like
        /*try{
            $facebook=new Facebook($this->getConfigFacebook());
            $signed_request = $facebook->getSignedRequest();
            $user=$facebook->getUser();

            $canvas_page = "http://www.facebook.com/unileverweb/app_559917344092598"; // direccion de a Tab
            $auth_url = "https://www.facebook.com/dialog/oauth?client_id=".$facebook->getAppId()
                ."&scope=publish_stream&redirect_uri=" . urlencode($canvas_page);

                if( $user){
                    if(isset($this->request->data['signed_request'])
                        && isset($signed_request["page"]["id"])
                        && $signed_request["page"]["liked"]){

                            //Esta en la TabFacebook
                            $user_permisos = $facebook->api('/me/permissions');
                            $permisos=$user_permisos['data'];

                            if(isset($permisos[0]['publish_stream'])){
                                $this->redirect(array('controller'=>'Home','action'=>'home'));
                            }else{
                                echo("<script> top.location.href='" .$auth_url. "'</script>");
                            }
                    }
                }else{
                    // esta en la web y redirect a TabFacebook
                    echo("<script> top.location.href='" .$auth_url. "'</script>");
                }
        }catch (Exception $e){
          //echo("<script> top.location.href='" .$auth_url. "'</script>");
        }*/
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
        if(strrpos(Router::url('/',true), "juancarlos") > 0) {
            $config = array('appId' => '592956160742908','secret'=>'c0a091f4d14cf78eb47f25bbb5a85376',
                'fileUpload' => false, 'cookie' => true);
        } else {
            if(strrpos(Router::url('/',true), "test") > 0) {
                $config = array('appId' => '559917344092598','secret'=>'6d7ec7106bca1dcc0765bd9c226b5ad3',
                    'fileUpload' => false, 'cookie' => true);
            }else{
                $config = array('appId' => '592956160742908','secret'=>'c0a091f4d14cf78eb47f25bbb5a85376',
                    'fileUpload' => false, 'cookie' => true);
            }
        }
        /*$config = array('appId' => '357963037671702','secret'=>'1a024c8d5b2600c04064fdab71d50d17',
            'fileUpload' => false, 'cookie' => true);*/
        return $config;
    }
}
