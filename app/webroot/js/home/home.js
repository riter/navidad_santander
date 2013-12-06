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
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Error');
            }
        });
    }
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
            alert('Error');
        }
    });
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
            alert('Error');
        }
    });

    /* Hilo que carga las fotos en los cuadros cada 3 segundos*/
    var interval = 5000;   //number of mili seconds between each call
    var refresh = function() {
        $.ajax({
            url: "/Home/ajax_reload_fotos",
            async:false,
            dataType: "json",
            data: '',
            cache: false,
            success: function(msg) {
                var datos=eval(msg);
                for(var i=0; i< 55; i++){
                    if(i < datos.length){
                        $('#'+i+' img').attr('src',datos[i].src);
                    }else{
                        $('#'+i+' img').attr('src','');
                    }

                }
                console.log(datos);

                setTimeout(function() {
                    refresh();
                }, interval);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert('Error');
            }
        });
    };
    refresh();
});