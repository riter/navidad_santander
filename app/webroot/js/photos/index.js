(function($) {
    $(document).ready(function(e) {
        /*$("#table_photos").dataTable({
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
        });*/

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

        /* Index tabla carga por ajax*/
         $("#table_photos").dataTable({

            "aoColumns":[
                {"bSortable": false,"bSearchable" : false},
                {"bSortable": true},
                {"bSortable": true},
                {"bSortable": true,"bSearchable" : false},
                {"bSortable": true}
            ],
            "aaSorting": [[0, "desc" ]],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "/admin/photos/lista_fotos",
            "oLanguage": {
                "sUrl": "/js/es_BO.txt"
            },
            //"sScrollX": "900px",
            "sPaginationType": "full_numbers",
            "bFilter": true,
            "fnDrawCallback": function(oSettings){
                $('.dataTables_paginate a').on('click',function(){
                    cantidadServer=0;
                    console.log(cantidadServer);
                });
                refresh();
            }
        });

        /* Hilo que carga las fotos en los cuadros cada 3 segundos y agregar posiciones*/
        var interval = 5000;   //number of mili seconds between each call
        var cantidadServer=0;
        function refresh() {
            $.ajax({
                url: "/photos/ajax_reload_fotos_admin/"+cantidadServer,
                async:true,
                dataType: "json",
                data: '',
                cache: false,
                success: function(msg) {
                    var datos=eval(msg);

                    if(cantidadServer != datos[''+Object.keys(datos).length-1].cantidad){
                        cantidadServer = datos[''+Object.keys(datos).length-1].cantidad;

                        for(var i=0; i< Object.keys(datos).length-1; i++){
                            var id=(datos[''+i].id);
                            if($('.'+id) != 'undefined'){
                                $('.'+id).html(i+1);
                            }
                        }
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                }
            });
        };
        setInterval(refresh,interval);

    });
}) (jQuery);