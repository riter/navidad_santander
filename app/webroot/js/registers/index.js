
$(document).ready(function() {

    $('#registro').click(function(){

        //Validacion de formulario

        var validar=$('#form_cliente').validate({
            rules: {
                "data[Client][nombre]": {
                    required: true
                },
                "data[Client][email]": {
                    required: true,
                    email:true
                }
            },
            errorPlacement: function(error, element) {
                $('#msg').css('display','block');
                $('#msg').html('*Existen campos vacios o incorrectos');
            }
        });
        function cerrar(){
            parent.$.fancybox.close();
            return true;
        }

        return validar && cerrar();
    });
});