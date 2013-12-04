$(document).ready(function() {
    $(".upload").fancybox({
        maxWidth	: 537,
        maxHeight	: 537,
        fitToView	: true,
        width		: '100%',
        height		: '100%',
        autoSize	: true,
        closeClick	: false,
        openEffect	: 'none',
        closeEffect	: 'none',
        padding: 0,
        regalo: true
    });

    $.ajax({
        url: "/premios/getListaPremios",
        async:false,
        dataType: "json",
        data: '',
        success: function(msg) {
            var datos=eval(msg);
            /*console.log(msg);
            console.log(msg.length);
            console.log(msg[0]);*/

            for(i=0; i< datos.length; i++){
               $('#'+datos[i].posicion+' .img').addClass(datos[i].html.img);
               $('#'+datos[i].posicion+' .box_color').addClass(datos[i].html.box);
               $('#'+datos[i].posicion+' .fecha').addClass(datos[i].html.txt);
               $('#'+datos[i].posicion+' .fecha').html(datos[i].descripcion);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Error');
        }
    });
});