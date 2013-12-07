<?
header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=Reporte_Usuarios".date('Y-m-d').".xls");
header("Cache-Control: max-age=0");
header("Expires: 0");

?>

<meta CHARSET="UTF-8">
<div>
    <div>
        <table  BORDER="1" BORDERCOLOR="black" CELLSPACING="0" style="font-family: 'Times New Roman', Georgia, Serif;" >
            <thead style="font-size: 12px;">
            <tr >
                <th style="background-color: #ffff00">Id</th>
                <th style="background-color: #ffff00">Nombre</th>
                <th style="background-color: #ffff00">Email</th>
                <th style="background-color: #ffff00">Telefono</th>
                <th style="background-color: #ffff00">Fecha de Registro</th>
            </tr>
            </thead>
            <tbody style="font-size: 12px;">
            <?php  if(count($clients)>0){
                    foreach ($clients as $client):
            ?>
                <tr>
                    <td>
                        <?= $client['Client']['id']; ?>
                    </td>
                    <td>
                        <?= $client['Client']['nombre']; ?>
                    </td>
                    <td>
                        <?= $client['Client']['email']; ?>
                    </td>
                    <td>
                        <?= $client['Client']['telefono']; ?>
                    </td>
                    <td>
                        <?= substr($client['Client']['created'],0,10); ?>
                    </td>
                </tr>
            <?php endforeach;
            }
            ?>
            </tbody>
        </table>
    </div>
</div>