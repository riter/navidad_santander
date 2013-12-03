<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class PremiosController extends AppController
{
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
} 