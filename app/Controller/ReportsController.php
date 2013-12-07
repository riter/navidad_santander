<?php
/**
 * Created by PhpStorm.
 * User: Riter
 * Date: 24/10/13
 * Time: 04:19 PM
 */

class  ReportsController extends AppController{

    public function admin_index(){
        $this->layout = '';
        try{
            $this->loadModel('Client');

            $this->set('clients', $this->Client->find('all', array('order' => array('Client.id' => 'asc'))));

        }catch (Exception $e){
        }
    }

    public function admin_winners(){
        $this->layout = '';
        try{
            $this->loadModel('Client');
            $winners = $this->Client->find('all',array('order'=>array('Client.id'=>'asc'),'limit'=>'50'));
            $this->set('clients', $winners);
            $this->render('admin_index');
        }catch (Exception $e){
        }
    }

} 