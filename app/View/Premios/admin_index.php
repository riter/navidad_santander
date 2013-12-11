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
            <?// echo $this->Form->create('Client', array('class' => 'da-form',
                //'url' => array('controller' => 'reports', 'action' => 'admin_winners')));
            ?>
            <!--<li>
                <input type="submit" name="boton" value="Boletos Export XLS" class="da-button blue large"/>
            </li>
            </form>-->
        </ul>
    </div>
    <div class="da-panel-content">
        <table id="table_premios" class="da-table">
            <thead>
            <tr>
                <th>Posicion</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th style="text-align: center;">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($premios as $premio): ?>
                <tr>
                    <td style="text-align: center">
                        <?= ($premio['Premio']['posicion']+1);?>
                    </td>
                    <td>
                        <?= $premio['Premio']['descripcion']; ?>
                    </td>
                    <td style="text-align: center">
                        <?= $this->Html->image('/premios/'.$premio['Premio']['imagen'], array('alt' => 'Logo','style'=>'width:50px;'));?>
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