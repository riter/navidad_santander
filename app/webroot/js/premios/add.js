(function ($) {
    $(document).ready(function (e) {
        /* Sumar 1 a la posicion por que en la base de datos empieza en 0*/
        $('#PremioPosicion').val(parseInt($('#PremioPosicion').val())+1);

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
                    required: true,
                    number:true,
                    min:1
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
                    required: 'Posicion requerido',
                    number: 'Numero Requerido',
                    min: 'El valor minimo es 1'
                }
            }
        });

        mostrarImg();

        $('#PremioImagen').change(mostrarImg);

        function mostrarImg(){
            if($("#PremioImagen option:selected").val()!=''){
                $('#img').attr('src','/premios/'+ $("#PremioImagen option:selected").val());
                $('#img').css('display','block');
            }else{
                $('#img').css('display','none');
            }
        }

    });
})(jQuery);