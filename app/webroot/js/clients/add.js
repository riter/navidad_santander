(function ($) {
    $(document).ready(function (e) {
        //Validacion de formulario
        $('#form_cliente').validate({
            rules: {
                "data[Client][nombre]": {
                    required: true
                },
                "data[Client][email]": {
                    required: true,
                    email:true
                },
                "data[Client][fecha_nac]": {
                    required: true,
                    date:true
                }
            },
            messages: {
                "data[Client][nombre]": {
                    required: 'Nombre requerido'
                },
                "data[Client][email]": {
                    required: 'Email requerido',
                    email: 'Email incorrecto'
                },
                "data[Client][fecha_nac]": {
                    required: 'Fecha Naciemiento requerido',
                    date: 'Fecha incorrecto'
                }
            }
        });
    });
})(jQuery);