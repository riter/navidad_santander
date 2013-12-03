<!-- DataTables Plugin -->
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min'); ?>
<!-- DataTables Plugin Funciones -->
<?= $this->Html->script('premios/index'); ?>

<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/list.png" alt="" />
            Listado de Premios
        </span>
    </div>
    <div class="da-panel-toolbar top">
        <ul>
            <li>
                <?= $this->Html->link($this->Html->image("/images/icons/color/add.png", array("alt" => "Agregar")).'Agregar', array('controller' => 'premios','action' => 'admin_add'), array('escape' => false)); ?>
            </li>
        </ul>
    </div>
    <div class="da-panel-content">
        <table id="table_premios" class="da-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th>Posicion</th>
                <th style="text-align: center;">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($premios as $premio): ?>
                <tr>
                    <td>
                        <?= $premio['Premio']['id']; ?>
                    </td>
                    <td>
                        <?= $premio['Premio']['descripcion']; ?>
                    </td>
                    <td>
                        <?= $this->Html->image('/logo_premios/'.$premio['Premio']['imagen'], array('alt' => 'Logo'));?>
                    </td>
                    <td>
                        <?= $premio['Premio']['posicion'];?>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $editar = $this->Html->image('/images/icons/color/pencil.png', array('alt' => 'Editar'));
                        $eliminar = $this->Html->image('/images/icons/color/cross.png', array('alt' => 'Eliminar'));
                        ?>
                        <?= $this->Html->link($editar, array('controller' => 'premios', 'action' => 'edit', $premio['Premio']['id']), array('escape' => false));?>
                        |
                        <?= $this->Form->postLink($eliminar, array('controller' => 'premios', 'action' => 'delete', $premio['Premio']['id']),array('confirm' => "Estas seguro de eliminar {$premio['Premio']['descripcion']}?", 'escape' => false))?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>