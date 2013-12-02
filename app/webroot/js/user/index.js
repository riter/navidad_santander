(function($) {
    $(document).ready(function(e) {
        $("#table_user").dataTable({
            "aaSorting": [[0, "desc" ]],
            "oLanguage": {
                "sUrl": "/js/es_BO.txt"
            },
            "bFilter": true
        });
    });
}) (jQuery);