<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <title>Yo lo quiero para Navidad | Santander Universidades</title>

    <link rel="stylesheet" href="/frontend_css/normalize.css">
    <link rel="stylesheet" href="/frontend_css/styles.css" />

    <!-- Add jQuery library -->
    <script type="text/javascript" src="/frontend_js/jquery-1.10.1.min.js"></script>

    <!-- Add fancyBox -->
    <link rel="stylesheet" href="/frontend_js/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="/frontend_js/jquery.fancybox.js?v=2.1.5"></script>
    <script type="text/javascript" src="/frontend_js/modernizr.js"></script>

    <script type="text/javascript" src="/js/home/home.js"></script>

</head>
<body>
<header>
    <div class="container">
        <div class="generador fleft">
            <a class="upload" data-fancybox-type="iframe" href="subir_foto.html"><img src="/frontend_images/upload_photo.png" alt="sube tu foto"></a>
        </div>
        <div class="logo fleft">
            <a href="/Home/home"><img src="/frontend_images/logo.png" alt="logo"></a>
        </div>
        <nav class="fright">
            <ul class="menu">
                <li><a href="#"><span>1</span> Sube tu foto con la mano levantada.</a></li>
                <li><a href="#"><span>2</span>Mantente al tanto de la posición de tu foto e intenta que al final de cada etapa, esté colocada en uno de los cuadros con premio.</a></li>
                <li><a href="#"><span>3</span>Puedes subir 3 fotos cada día. Utiliza tus oportunidades para desplazar a los demás y colocar tus fotos en los cuadros premiados.</a></li>
            </ul>
        </nav>
    </div>
</header>
<section>
    <div class="container">
        <div class="boxes">

            <? $posicion=0;
                for($f=0; $f<5; $f++){
                echo '<ul>';
                for($c=0; $c<11; $c++){
                    ?>
                    <li>
                        <div class="box" id="<?=$posicion?>">
                            <div class="img"></div>
                            <div class="box_color ">
                                <img src="" alt="">
                            </div>
                            <span class="fecha">

                            </span>
                        </div>
                    </li>
                <?
                  $posicion++;
                }
                echo '</ul>';
            }
            ?>

        </div>
    </div>
</section>
<footer>
    <div class="container">
        <h3>Todos los derechos reservados Santander Universidades 2013.</h3>
    </div>
</footer>
</body>
</html>