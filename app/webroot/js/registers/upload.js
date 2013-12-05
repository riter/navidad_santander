$(document).ready(function() {

    $('.buscar_foto').click(function(){
       $('#file').click();
    });

    function archivo(evt) {
        var files = evt.target.files; // FileList object

        // Obtenemos la imagen del campo "file".
        for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    // Insertamos la imagen
                    //document.getElementById("preview").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    $('#preview').addClass('thumb');
                    $('#preview').attr('src',e.target.result);
                    $('#preview').attr('title',escape(theFile.name));

                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    $('#file').change(function(evt){
        var val = $(this).val();

        switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
            case 'gif': case 'jpg': case 'png': case 'jpeg':
             archivo(evt);
            break;
            default:
                $(this).val('');
                // error message here
                $('#preview').attr('src','/frontend_images/avatar.png');
                break;
        }
    });
    $('#subir').click(function(){
        if($('#file').val()==''){
            return false;
        }
    });
    /*$.ajax({
     url: "/registers/validar",
     async:false,
     type:'post',
     data: $("#form_upload").serialize(),
     //dataType: "json",
     success: function(msg) {
     if(!msg=='true'){
     alert(msg);
     $(this).val('');
     }
     alert(msg);
     },
     error: function (xhr, ajaxOptions, thrownError) {
     alert('Error');
     }
     });*/
    //document.getElementById('file').click(function(){return false;})

    /*$.ajax({
        url: "/premios/getListaPremios",
        async:false,
        dataType: "json",
        data: '',
        success: function(msg) {
            var datos=eval(msg);

            for(i=0; i< datos.length; i++){
               $('#'+datos[i].posicion+' .img').addClass(datos[i].html.img);
               $('#'+datos[i].posicion+' .box_color').addClass(datos[i].html.box);
               $('#'+datos[i].posicion+' .fecha').addClass(datos[i].html.txt);
               $('#'+datos[i].posicion+' .fecha').html(datos[i].descripcion);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert('Error');
        }
    });*/

    // minimum
    $('#preview').jWindowCrop({
        targetWidth:205,
        targetHeight:205,
        smartControls: true,
        showControlsOnStart: false,
        onChange: function(result) {
            $('#crop_x').val(result.cropX);
            $('#crop_y').val(result.cropY);
            $('#crop_w').val(result.cropW);
            $('#crop_h').val(result.cropH);
        }
    });
});