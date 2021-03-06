<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Subir foto</title>
    <link rel="stylesheet" href="/frontend_css/normalize.css">
    <link rel="stylesheet" href="/frontend_css/registro.css">
    <link rel="stylesheet" href="/frontend_css/jWindowCrop.css">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="/frontend_js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/js/registers/jquery.jWindowCrop.js"></script>
    <script type="text/javascript" src="/js/registers/upload.js"></script>

    <!-- Add Plugin Cheese WebCam library-->
    <script type="text/javascript" src="/plugins/say-cheese/say-cheese.js"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/frontend_js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/frontend_js/jquery.fancybox.js?v=2.1.5"></script>

</head>
<body>
<section>
    <div class="subir_foto">
        <h2>Sube tu foto</h2>
        <form action="upload" enctype='multipart/form-data' method="post" id="form_upload">
            <ul>
                <li><a class="webcam" href="#">Usar webcam</a></li>
                <li><a class="buscar_foto" href="#">Subir desde ordenador</a></li>
                <div style="width: 0; height: 0; overflow: hidden;">
                    <input type="file" id="file" name="file"  accept='image/*'>
                </div>
            </ul>
            <figure>
                <div id="preview_cam" style="display: none"></div>
                <img src="/frontend_images/avatar.png" alt="" id="preview">
                <input type="submit" value="Subir foto" id="subir">
            </figure>
            <input type="hidden" value="" id="crop_x" name="cropX">
            <input type="hidden" value="" id="crop_y" name="cropY">
            <input type="hidden" value="" id="crop_w" name="cropW">
            <input type="hidden" value="" id="crop_h" name="cropH">
            <input type="hidden" value="" id="img_h" name="imgH">
        </form>
    </div>
</section>
</body>
</html>