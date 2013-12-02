//(function($) {
    $("#form_users").validate({
        rules: {
            "data[User][username]": {
                required: true
            },
            "data[User][password]": {
                required: true,
                minlength: 5
            },
            "data[User][confirm_password]": {
                required: true,
                minlength: 5,
                equalTo: '#UserPassword'
            }
        },
        messages: {
            "data[User][username]":{
                required: "Usuario requerido"
            },
            "data[User][password]": {
                required: "Pasword requerido",
                minlength: "Porfavor ingresa minimo 5 caracteres."
            },
            "data[User][confirm_password]":{
                required: "Pasword requerido",
                minlength: "Porfavor ingresa minimo 5 caracteres.",
                equalTo: "Los password no coinciden"
            }
        }
    });
//}) (jQuery);