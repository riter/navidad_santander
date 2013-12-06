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
            "aaSorting": [[0, "desc" ]],
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
    });
}) (jQuery);