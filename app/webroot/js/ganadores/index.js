(function($) {
    $(document).ready(function(e) {
        $("#table_ganadores").dataTable({
            "aoColumns":[
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": false, "bSearchable" : false},
                {"bSortable": false, "bSearchable" : false}
            ],
            "aaSorting": [[4, "asc" ]],
            "oLanguage": {
                "sUrl": "/js/es_BO.txt"
            },
            "sPaginationType": "full_numbers",
            "bFilter": true
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

                    var lspos=$('.posicion');
                    for(var x=0; x<lspos.length; x++){
                        var pos=$('.posicion:eq('+x+')').html();
                        pos=parseInt(pos)-1;

                        $('tbody tr:eq('+x+') td:eq(0) > input').attr('value',datos[pos].id);
                        $('tbody tr:eq('+x+') td:eq(1)').html(datos[pos].cliente_id);
                        $('tbody tr:eq('+x+') td:eq(2)').html(datos[pos].cliente_nombre);
                        $('tbody tr:eq('+x+') td:eq(3) > img').attr('src',datos[pos].src);

                    }

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