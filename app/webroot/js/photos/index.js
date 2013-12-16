(function($) {
    $(document).ready(function(e) {
        $("#table_photos").dataTable({
            "aoColumns":[
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": false, "bSearchable" : false}
            ],
            "aaSorting": [[0, "asc" ]],
            "oLanguage": {
                "sUrl": "/js/es_BO.txt"
            },
            "sPaginationType": "full_numbers",
            "bFilter": true
        });

        $('.moderar').on('click',function(){

            $.fancybox.open({
                href : $(this).attr('href'),
                width	: 300,
                height	: 400,
                fitToView	: false,
                autoSize	: true,
                closeClick	: false,
                openEffect	: 'none',
                closeEffect	: 'none',
                padding: 0,
                type : 'ajax'
            });

            $.fancybox.close = function() {
                parent.location.reload();
                return true;
            };

           return false;
        });

        /* Hilo que carga las fotos en los cuadros cada 3 segundos y agregar posiciones*/
        var interval = 5000;   //number of mili seconds between each call
        var cantidadServer=0;
        var refresh = function() {
            $.ajax({
                url: "/photos/ajax_reload_fotos_admin/",
                async:false,
                dataType: "json",
                data: '',
                cache: false,
                success: function(msg) {
                    var datos=eval(msg);
                    //console.log(datos);
                    for(var i=0; i< Object.keys(datos).length; i++){
                        //console.log($('#'+datos[i].id));
                        if($('#'+datos[''+i].id) != 'undefined'){
                            //console.log($('#'+datos[''+i]));
                            $('#'+datos[''+i].id).html(i+1);
                        }else{

                        }
                    }
                    //console.log('termino');
                    cantidadServer = datos[''+Object.keys(datos).length-1].cantidad;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                }
            });
        };
        setInterval(refresh,interval);
        refresh();
    });
}) (jQuery);