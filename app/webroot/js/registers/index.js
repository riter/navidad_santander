
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
        if(validar){
            /*$.ajax({
                url: "/registers/index",
                async:false,
                type:'post',
                data: '',
                success: function(msg) {
                    parent.$.fancybox.close();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Error');
                }
            });*/
            return true;
        }
        return false;
    });
});