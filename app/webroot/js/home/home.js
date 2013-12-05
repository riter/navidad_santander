$(document).ready(function() {
    $(".upload").fancybox({
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
        regalo: true
    });

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
            if(msg=='registro'){
                //$(".upload").attr('href','/registers/index');
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
                    parent.location.reload();
                    return true;
                };
            }else{
                if(msg=='like'){
                    //$(".upload").attr('href','/Home/like');
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
                        parent.location.reload();
                        return true;
                    };
                }
            }

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Error');
        }
    });
});