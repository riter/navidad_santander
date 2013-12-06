$(document).ready(function() {
    var opcion = '';

    /* Proceso para subir Imagenes*/
    $('.buscar_foto').click(function(){
       $('#file').click();
       opcion='file';
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
        $('.jwc_frame').css('display','block');
        $('#preview_cam').css('display','none');

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

    /* Proceso de subir foto capturada con WebCam*/
    var sayCheese = new SayCheese('#preview_cam', { snapshots: true, width:205, height:205});

    $('.webcam').click(function(){
        $('.jwc_frame').css('display','none');
        //$('#file').val('');
        $('#preview_cam').css('display','block');
        /*ver si el contendor de la webcam tiene un tag video entonces dar start*/
        if($('#preview_cam').html() == ''){
            sayCheese.start();
        }
        opcion='webcam';
    });
    sayCheese.on('snapshot', function(snapshot) {
        $('.jwc_frame').css('display','block');
        $('#preview_cam').css('display','none');

        $('#preview').addClass('thumb');
        $('#preview').attr('src',snapshot.toDataURL('image/png'));
        //$('#preview').attr('title',escape(theFile.name));
    });
    /* Validar si la imagen esta vacia*/
    $('#subir').click(function(){


        if(opcion=='webcam'){
            /* se captura la foto y se guarda por ajax, se envia la img(src) por  POST*/
            sayCheese.takeSnapshot(sayCheese.options.width,sayCheese.options.height);
            var src=$('#preview').attr('src');
            //console.log(src);
            data={
                src: src
            };
            $.ajax({
                url: "/registers/ajax_saveImg",
                async:false,
                type: "post",
                data:data,
                beforeSend: function(){
                    $("body").append('<div id="fancybox-loading"><div></div></div>');
                },
                success: function(msg) {
                    window.location.href = msg;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert('Error');
                }
            });
            //return true;
        }else{
            //se guarda por file y los datos van por POST
            if(opcion='file'){
                $("body").append('<div id="fancybox-loading"><div></div></div>');
                return  true;
            }
        }
        return false;
        /*
        if($('#file').val()==''){
            return false;
        }*/
    });

    // minimum Crop de Imagen
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