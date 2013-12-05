<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Subir foto</title>
    <link rel="stylesheet" href="/frontend_css/normalize.css">
    <link rel="stylesheet" href="/frontend_css/registro.css">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="/frontend_js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/js/registers/upload.js"></script>
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
            <figure style="overflow: hidden">
                <img src="/frontend_images/avatar.png" alt="" id="preview">
                <input type="submit" value="Subir foto" id="subir">
            </figure>
        </form>
    </div>
</section>
</body>
</html>