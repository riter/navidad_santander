(function($) {
    $(document).ready(function(e) {
        $("#table_photos").dataTable({
            "aoColumns":[
                {"bSortable": true},
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
        var refresh = function() {
            $.ajax({
                url: "/photos/ajax_reload_fotos",
                async:false,
                dataType: "json",
                data: '',
                cache: false,
                success: function(msg) {
                    var datos=eval(msg);
                    for(var i=0; i< datos.length; i++){
                        //console.log($('#'+datos[i].id));
                        if($('#'+datos[i].id).length > 0){
                            $('#'+datos[i].id).html(i+1);
                        }else{
                            //location.reload();
                        }
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
    });
}) (jQuery);