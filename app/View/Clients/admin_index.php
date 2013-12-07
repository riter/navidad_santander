<!-- DataTables Plugin -->
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min'); ?>
<!-- DataTables Plugin Funciones -->
<?= $this->Html->script('clients/index'); ?>

<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/list.png" alt="" />
            Listado de Usuarios
        </span>
    </div>

    <div class="da-panel-toolbar top">
        <ul>
            <?php echo $this->Form->create('Client', array('class' => 'da-form',
                'url' => array('controller' => 'reports', 'action' => 'admin_index')));
            ?>
            <li>
                <input type="submit" name="boton" value="Exportar XLS" class="da-button blue large"/>
            </li>
            </form>
        </ul>
    </div>
    <div class="da-panel-content">
        <table id="table_clients" class="da-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Telefono</th>
                <th style="text-align: center;">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td>
                        <?= $client['Client']['id']; ?>
                    </td>
                    <td>
                        <?= $client['Client']['nombre']; ?>
                    </td>
                    <td>
                        <?= $client['Client']['email'];?>
                    </td>
                    <td>
                        <?= $client['Client']['telefono'];?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $editar = $this->Html->image('/images/icons/color/pencil.png', array('alt' => 'Editar'));
                        $eliminar = $this->Html->image('/images/icons/color/cross.png', array('alt' => 'Eliminar'));
                        ?>
                        <?= $this->Html->link($editar, array('controller' => 'clients', 'action' => 'edit', $client['Client']['id']), array('escape' => false));?>
                        |
                        <?= $this->Form->postLink($eliminar, array('controller' => 'clients', 'action' => 'delete', $client['Client']['id']),array('confirm' => "Estas seguro de eliminar {$client['Client']['nombre']}?", 'escape' => false))?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>