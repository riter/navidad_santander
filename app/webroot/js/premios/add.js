(function ($) {
    $(document).ready(function (e) {
        //Validacion de formulario
        $('#form_premio').validate({
            rules: {
                "data[Premio][descripcion]": {
                    required: true
                },
                "data[Premio][imagen]": {
                    required: true
                },
                "data[Premio][posicion]": {
                    required: true
                }
            },
            messages: {
                "data[Premio][descripcion]": {
                    required: 'Descripcion requerido'
                },
                "data[Premio][imagen]": {
                    required: 'Imagen requerido'
                },
                "data[Premio][posicion]": {
                    required: 'Posicion requerido'
                }
            }
        });
    });
})(jQuery);