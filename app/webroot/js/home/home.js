$(document).ready(function() {

    $('.boxes').sbscroller();

    /* Validar si cargo las 3 fotos del dia en el Boton Subiir foto*/
    $(".upload").on('click',upload);
    function upload(){
        $.ajax({
            url: "/registers/ajax_Upload",
            async:false,
            data: '',
            success: function(msg) {
                if(msg=='upload_true'){
                    $.fancybox.open({
                        href:'/registers/upload',
                        maxWidth	: 537,
                        maxHeight	: 537,
                        fitToView	: true,
                        autoSize	: true,
                        closeClick	: false,
                        openEffect	: 'none',
                        closeEffect	: 'none',
                        padding: 0,
                        type:'iframe',
                        regalo: true
                    });
                }else{
                    if(msg =='upload_false'){
                        $.fancybox.open({
                            href:'/registers/upload_completed',
                            maxWidth	: 537,
                            maxHeight	: 537,
                            fitToView	: true,
                            autoSize	: true,
                            closeClick	: false,
                            openEffect	: 'none',
                            closeEffect	: 'none',
                            padding: 0,
                            type:'iframe',
                            regalo: false
                        });
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert('Error');
            }
        });
    }

    /* Consulta para ver si muestra popup de like o registro */
    $.ajax({
        url: "/Home/getPopup",
        async:false,
        //dataType: "json",
        data: '',
        success: function(msg) {
            //var datos=eval(msg);
            switch (msg){
                case 'registro':
                    $.fancybox.open({
                        href:'/registers/index',
                        maxWidth	: 537,
                        maxHeight	: 537,
                        fitToView	: true,
                        // width		: '100%',
                        // height		: '100%',
                        autoSize	: true,
                        closeClick	: false,
                        closeBtn : false,
                        openEffect	: 'none',
                        closeEffect	: 'none',
                        padding: 0,
                        regalo: true,
                        type:'iframe'
                    });
                    $.fancybox.close = function() {
                        return false;
                    };
                    break;
                case 'like':
                    $.fancybox.open({
                        href:'/Home/like',
                        maxWidth	: 537,
                        maxHeight	: 537,
                        fitToView	: true,
                        // width		: '100%',
                        // height		: '100%',
                        autoSize	: true,
                        closeClick	: false,
                        closeBtn : false,
                        openEffect	: 'none',
                        closeEffect	: 'none',
                        padding: 0,
                        regalo: false,
                        type:'iframe'
                    });
                    $.fancybox.close = function() {
                        return false;
                    };
                    break;
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //alert('Error');
        }
    });
    /* Se creara mas fila si hay mas de 55 fotos*/
    var canFilas=$('.boxes ul').length-1;
    function crearFila(canDatos){
        var canCol=$('.boxes ul:first-child li').length;
        //alert(canCol);
        //var canCol=11;
        var newCantFilas=Math.floor(canDatos/canCol);
        if((canDatos % canCol) > 0){
            newCantFilas++;
        }
        var posicion= canFilas * canCol;
        if(canFilas<newCantFilas){
            for(var i=canFilas; i<newCantFilas; i++){
                var htmlFila="<ul>";
                for(var c=0; c<canCol; c++){
                    htmlFila+=$('ul.ejemplo').html();
                    htmlFila=htmlFila.replace("idEjm",posicion);
                    posicion++;
                }
                htmlFila+="</ul>";
                $('.boxes').append(htmlFila);
            }
            canFilas=newCantFilas;
            //console.log('entro');
        }
        return posicion;
    }

    /* Hilo que carga las fotos en los cuadros cada 3 segundos*/
    var interval = 5000;   //number of mili seconds between each call
    var cantidadServer=0;
    var refresh = function() {
        $.ajax({
            url: "/photos/ajax_reload_fotos/"+cantidadServer,
            async:false,
            dataType: "json",
            data: '',
            cache: false,
            success: function(msg) {
                var datos=eval(msg);
                var posicion=crearFila(datos.length);

                //console.log(datos.length);
                if(cantidadServer < datos.length){
                    for(var i=0; i< posicion; i++){
                        if(i < datos.length){
                            $('#'+i+' img').attr('src',datos[i].src);
                        }else{
                            $('#'+i+' img').attr('src','');
                        }

                    }
                    cantidadServer=datos.length;
                }
                //console.log(datos);

                setTimeout(function() {
                    refresh();
                }, interval);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                //alert('Error');
            }
        });
    };
    refresh();

    /* Consulta e inserta la lista de premios en la Home*/
    $.ajax({
         url: "/premios/getListaPremios",
         async:false,
         dataType: "json",
         data: '',
         success: function(msg) {
             var datos=eval(msg);

             for(i=0; i< datos.length; i++){
                 $('#'+datos[i].posicion+' .img').addClass(datos[i].html.img);
                 $('#'+datos[i].posicion+' .box_color').addClass(datos[i].html.box);
                 $('#'+datos[i].posicion+' .fecha').addClass(datos[i].html.txt);
                 $('#'+datos[i].posicion+' .fecha').html(datos[i].descripcion);
             }
         },
         error: function (xhr, ajaxOptions, thrownError) {
            //alert('Error');
         }
     });
});