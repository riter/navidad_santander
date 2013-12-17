<?php
//--- Output
$output = array(
    "sEcho" => $sEcho,
    "iTotalRecords" => $iTotal,
    "iTotalDisplayRecords" => $iFilteredTotal,
    "aaData" => array()
);

foreach ($photos as $photo):

    $estado=$photo['Photo']['estado'];

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

    $row = array();
    $row[] = '<span class="'.$photo['Photo']['id'].'"></span>';
    $row[] = $photo['Client']['nombre'];
    $row[] = $photo['Photo']['fecha'];

    //$row[] = "<div style='text-align: center' class='moderar'><img src='".$photo['Photo']['nombre']."' alt='' style='max-width: 50px; max-height: 50px;'> </div>";
    $ver = $this->Html->image($photo['Photo']['nombre'], array('alt' => 'Moderar','style'=>'max-width: 50px; max-height: 50px;'));
    $row[] = $this->Html->link($ver, array('controller' => 'photos', 'action' => 'ver',$photo['Photo']['id'] ), array('class'=>'moderar','style'=>'display: block; text-align: center;','escape' => false));
    $row[] ="<div style='background-color: ".$color."; padding: 5px;'>".
            "<span>".
                "<img src='/images/icons/color/".$img.".png' alt=''>".
                $txt.
            "</span>".
         "</div>";

        //$ver = $this->Html->image('/images/icons/color/magnifier.png', array('alt' => 'Moderar'));
        $eliminar = $this->Html->image('/images/icons/color/cross.png', array('alt' => 'Eliminar'));

    $row[] =$this->Form->postLink($eliminar, array('controller' => 'photos', 'action' => 'delete', $photo['Photo']['id']),array('confirm' => "Estas seguro de eliminar la foto con id = {$photo['Photo']['id']}?" ,'style'=>'display: block; text-align: center;', 'escape' => false));

    $output['aaData'][] = $row;
endforeach;
echo json_encode($output);
?>