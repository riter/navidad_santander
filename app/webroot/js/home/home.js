$(document).ready(function() {

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

    /* Inicializacion sbscroller*/
    $('.boxes').sbscroller();

    /* Se creara mas fila si hay mas de 55 fotos*/
    var canFilas=$('.boxes ul').length-1;
    function crearFila(canDatos){
        var canCol=$('.boxes ul:first-child li').length;
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

                $('.boxes > .scroll-content').append(htmlFila);
            }
            canFilas=newCantFilas;
            //refreshSbroller();
            $('.boxes').sbscroller('refresh');
        }
        return posicion;
    }

    /* Hilo que carga las fotos en los cuadros cada 5 segundos*/
    var interval = 10000;   //number of mili seconds between each call
    var cantidadServer=0;
    function refresh() {
        $.ajax({
            url: "/photos/ajax_reload_fotos/"+cantidadServer,
            async:true,
            dataType: "json",
            data: '',
            cache: false,
            success: function(msg) {
                var datos=eval(msg);

                if(cantidadServer != datos[''+Object.keys(datos).length-1].cantidad){
                    var cantCuadros=crearFila(Object.keys(datos).length);
                    cantidadServer = datos[''+Object.keys(datos).length-1].cantidad;
                    for(var i=0; i< cantCuadros; i++){

                        if(i < Object.keys(datos).length){
                            $('#'+ i +' img').attr('src',datos[''+i].src);
                        }else{
                            $('#'+ i +' img').attr('src','');
                        }

                    }

                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
            }
        });
    };
    setInterval(refresh,interval);
    refresh();
    /*setTimeout(function() {
        refresh();
    }, interval);*/
    //refresh();

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