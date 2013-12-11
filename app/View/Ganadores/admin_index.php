<!-- DataTables Plugin -->
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min'); ?>
<!-- DataTables Plugin Funciones -->
<?= $this->Html->script('ganadores/index'); ?>


<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/list.png" alt="" />
            Listado de Premios
        </span>
    </div>

    <?php echo $this->Form->create('Premio_cliente', array(
        'url' => array('controller' => 'ganadores', 'action' => 'index')));
    ?>

    <div class="da-panel-toolbar top">
        <ul>
            <li>
                <a href="/admin/reports/winners" class="da-button blue input-medium" style="color: #FFFFFF;"> Ganadores Boletos XLS</a>
            </li>

            <li>
                    <input type="submit" name="boton" value="Guardar Ganadores" class="da-button orange input-medium"  style="height: 31px;"/>
            </li>

        </ul>
    </div>
    <div class="da-panel-content">
        <table id="table_ganadores" class="da-table">
            <thead>
            <tr>
                <th>Ganador</th>
                <th>Id Usuario</th>
                <th>Nombre Usuario</th>
                <th>Imagen Usuario</th>
                <th>Posicion</th>
                <th>Descripcion</th>
                <th>Imagen Premio</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($premios as $premio): ?>
                <tr>
                    <td style="text-align: center">
                        <?
                            if(isset($premio['Premio_cliente']) && count($premio['Premio_cliente']) > 0){
                                echo '¡GANADOR!';
                            }else{
                        ?>
                                <input type="checkbox" name="data[Premio_cliente][<?= ($premio['Premio']['id']);?>]" value="" >
                        <?
                            }
                        ?>
                    </td>
                    <td style="text-align: center">

                    </td>
                    <td style="text-align: center">

                    </td>
                    <td style="text-align: center">
                        <img src="" alt="" style="width:80px;">
                    </td>
                    <td style="text-align: center" class="posicion">
                        <?= ($premio['Premio']['posicion']+1);?>
                    </td>
                    <td>
                        <?= $premio['Premio']['descripcion']; ?>
                    </td>
                    <td style="text-align: center">
                        <?= $this->Html->image('/premios/'.$premio['Premio']['imagen'], array('alt' => 'Logo','style'=>'width:50px;'));?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</form>