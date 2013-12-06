$(document).ready(function() {

    $(".upload").on('click',upload);
    function upload(){
        $.ajax({
            url: "/registers/ajax_Upload",
            async:false,
            //dataType: "json",
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
                        openEffect	: 'none',
                        closeEffect	: 'none',
                        padding: 0,
                        type:'iframe'
                    });
                    $.fancybox.close = function() {
                        location.reload();
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
                        openEffect	: 'none',
                        closeEffect	: 'none',
                        padding: 0,
                        type:'iframe'
                    });
                    $.fancybox.close = function() {
                        location.reload();
                    };
                    break;
                /*case 'upload_true':
                    $(".upload").on('click',upload);
                    break;
                case 'upload_false':
                    $(".upload").on('click',function(){
                       return false;
                    });
                    break;*/
            }
            /*if(msg=='registro'){
                //$(".upload").attr('href','/registers/index');

            }else{
                if(msg=='like'){

                }else{
                    if(msg=='upload_true'){

                    }

                }
            }*/

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Error');
        }
    });
});