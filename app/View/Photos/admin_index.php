<!-- DataTables Plugin -->
<?= $this->Html->script('../plugins/datatables/jquery.dataTables.min'); ?>
<!-- DataTables Plugin Funciones -->
<?= $this->Html->script('photos/index'); ?>

<!--//**********fancyBox-->
<link href="/plugins/fancy/jquery.fancybox.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="/plugins/fancy/jquery.fancybox.pack.js" type="text/javascript"></script>

<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/list.png" alt="" />
            Listado de Fotos
        </span>
    </div>
    <div class="da-panel-content">
        <table id="table_photos" class="da-table">
            <thead>
            <tr>
                <th>Posicion</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th style="text-align: center;">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $posicion=1;
                foreach ($photos as $photo):
                ?>
                <tr>
                    <td id="<?= $photo['Photo']['id']; ?>">
                        <? echo $posicion; $posicion++;?>
                    </td>
                    <td>
                        <?= $photo['Client']['nombre']; ?>
                    </td>
                    <td>
                        <?= $photo['Photo']['fecha']; ?>
                    </td>

                        <?$estado=$photo['Photo']['estado'];

                            switch($estado){
                                case 0:$color='rgb(250,179,65);';
                                       $img='add';
                                       $txt='Nuevo';
                                break;
                                case 1:$color='rgb(167,208,55)';
                                    $img='accept';
                                    $txt='Aceptado';
                                    break;
                                case 2:$color='rgb(225,86,86)';
                                    $img='cancel';
                                    $txt='Rechazado';
                                    break;
                            }
                        ?>
                    <td >
                        <div style="background-color: <?=$color?>; padding: 5px;">
                        <span  >
                            <img src="/images/icons/color/<?=$img?>.png" alt="">
                            <?=$txt?>
                        </span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <?php
                        $ver = $this->Html->image('/images/icons/color/magnifier.png', array('alt' => 'Moderar'));
                        $eliminar = $this->Html->image('/images/icons/color/cross.png', array('alt' => 'Eliminar'));
                        ?>
                        <?= $this->Html->link($ver, array('controller' => 'photos', 'action' => 'ver',$photo['Photo']['id'] ), array('class'=>'moderar','escape' => false));?>
                        |
                        <?= $this->Form->postLink($eliminar, array('controller' => 'photos', 'action' => 'delete', $photo['Photo']['id']),array('confirm' => "Estas seguro de eliminar la foto con id = {$photo['Photo']['id']}?", 'escape' => false))?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>