$(document).ready(function() {
    // minimum Crop de Imagen


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
                    $('#preview').addClass('thumb');
                    $('#preview').attr('src',e.target.result);
                    $('#preview').attr('title',escape(theFile.name));

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
                alert('Tipo de Archivo Incorrecto');
                $(this).val('');
                $('#preview').attr('src','/frontend_images/avatar.png');
                break;
        }
    });

    /* Proceso de subir foto capturada con WebCam*/
    var sayCheese = new SayCheese('#preview_cam', { snapshots: true, width:205, height:205});

    $('.webcam').click(function(){
        $('.jwc_frame').css('display','none');
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


        if(opcion=='webcam' && $('#preview_cam').html() != ''){
            /* se captura la foto y se guarda por ajax, se envia la img(src) por  POST*/
            sayCheese.takeSnapshot(sayCheese.options.width,sayCheese.options.height);
            var src=$('#preview').attr('src');
            data={
                src: src
            };
            $.ajax({
                url: "/registers/ajax_saveImg",
                //async:false,
                type: "post",
                data:data,
                beforeSend: function(){
                    $("body").append('<div id="fancybox-loading"><div></div></div>');
                },
                success: function(msg) {
                    window.location.href = msg;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    //alert('Error');
                }
            });

        }else{
            //se guarda por file y los datos van por POST
            if(opcion=='file' && $('#file').val()){
                $('#img_h').val($('.jwc_frame img').height()); // nuevo tamaño de la imagen
                $("body").append('<div id="fancybox-loading"><div></div></div>');
                return  true;
            }else{
                alert('No existe foto para subir');
            }
        }
        return false;

    });


});