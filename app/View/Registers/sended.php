<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Mensaje Subir Foto</title>
    <link rel="stylesheet" href="/frontend_css/normalize.css">
    <link rel="stylesheet" href="/frontend_css/registro.css">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="/frontend_js/jquery-1.10.1.min.js"></script>
    <script src="https://connect.facebook.net/en_US/all.js"></script>
    <script>
        FB.init({
            appId  : '559917344092598',
            status : true,
            cookie : true,
            frictionlessRequests : true,
            oauth: true
        });
        $(document).ready(function(){
           $('#invitar').click(function(){

               FB.ui({method: 'apprequests',
                   to:[],
                   display:'popup',
                   message: 'Participa ahora!. En el concurso Yo lo quiero para Navidad'
               }, requestCallback);

               return false;
           }) ;
        });

        function requestCallback(response) {
            // Handle callback here
            console.log(response);
            if (response != undefined) {
                parent.$.fancybox.close();
                parent.location.reload();
            }else{
               // $('.message_alert').show();
                //$('.message_alert').html('<span>Error al Enviar invitaciones</span>');
                //alert('Error al Enviar invitaciones');
            }
        }
    </script>
</head>
<body>
<section>
    <div class="mensaje_subida">
        <h2>"Tu foto se subió con éxito"</h2>
        <p>Invita a tus amigos a participar.</p>
        <form action="">
            <ul>
                <li><input type="submit" value="Invitar a mis amigos" id="invitar"></li>
            </ul>
        </form>
    </div>
    <!-- <img class="regalo" src="images/regalo.png" alt="regalo"> -->
</section>
</body>
</html>