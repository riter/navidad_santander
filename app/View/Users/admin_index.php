<!-- DataTables Plugin -->
<?php echo $this->Html->script('../plugins/datatables/jquery.dataTables.min'); ?>
<!-- DataTables Plugin Funciones -->
<?php echo $this->Html->script('user/index'); ?>
<?php
/*
    echo "<pre>";
    print_r($this->data);
    echo "</pre>";
*/
?>

<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/list.png" alt="" />
            Listado de Usuarios
        </span>
    </div>
    <div class="da-panel-toolbar top">
        <ul>
            <li>
                <?php
                echo $this->Html->link($this->Html->image("/images/icons/color/add.png", array("alt" => "Agregar")).'Agregar', array('controller' => 'users','action' => 'add'), array('escape' => false));
                ?>
            </li>
        </ul>
    </div>
    <div class="da-panel-content">
        <table id="table_user" class="da-table">
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php echo $user['User']['id']; ?>
                    </td>
                    <td>
                        <?php echo $user['User']['username'];?>
                    </td>
                    <td>
                        <?php echo $user['User']['role']; ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($this->Html->image('/images/icons/color/pencil.png', array('alt' => 'Editar')), array('action' => 'edit', $user['User']['id']),array('escape' => false));?>
                        |
                        <?php echo $this->Form->postLink($this->Html->image('/images/icons/color/cross.png', array('alt' => 'Eliminar')), array('action' => 'delete', $user['User']['id']),array('escape' => false,'confirm' => 'Are you sure?'))?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>