<?php
/**
 * Created by PhpStorm.
 * User: Luis Miguel Torrico
 * Date: 24-10-13
 * Time: 05:26 PM
 */

class ClientsController extends AppController
{
    public function admin_index()
    {
        $this->set('title_page', 'Admin - Usuario');
        $this->layout = 'backend';
        $clientes = $this->Client->find('all');
        $this->set('clients', $clientes);
    }

    public function admin_add()
    {
        $this->set('title_page', 'Admin - Adicionar Usuario');
        $this->layout = 'backend';
        if ($this->request->is('post')) {
            $datos = $this->request->data;
            if ($this->Client->save($datos)) {
                $this->Session->setFlash('Su Usuario fue registrada', 'success_message');
                $this->redirect(array('controller' => 'clients', 'action' => 'index'));
            }
        }
    }

    public function admin_edit($id = null)
    {
        $this->set('title_page', 'Admin - Editar Usuario');
        $this->layout = 'backend';
        $this->Client->id = $id;
        if ($this->request->is('get')) {
            $Usuario = $this->Client->read();
            $this->request->data = $Usuario;
            $this->render('admin_add');
        } else {
            $datos = $this->request->data;
            if ($this->Client->save($datos)) {
                $this->Session->setFlash('Su Usuario fue actualizada', 'success_message');
                $this->redirect(array('controller' => 'clients', 'action' => 'index'));
            }
        }
    }

    public function admin_delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        try {
            if ($this->Client->delete($id, true)) {
                $this->Session->setFlash('El Usuario con id: ' . $id . ' fue eliminada', 'success_message');
            }
        } catch (Exception $e) {
            $this->Session->setFlash('Error: No se puede eliminar el Usuario con id: ' . $id . ' porque tiene referencias', 'error_message');
        }
        $this->redirect(array('controller' => 'clients', 'action' => 'index'));
    }
} 