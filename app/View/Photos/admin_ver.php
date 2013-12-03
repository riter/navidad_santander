<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>

    <div class="da-panel" >
        <div class="da-panel-header">
            <span class="da-panel-title">
                <img src="images/icons/black/16/settings.png" alt="">
                Moderar Fotografia
            </span>
        </div>
        <div class="da-panel-content with-padding">
            <div>
                <img src="<?= $img;?>" alt=""/>
            </div>
            <p>
                <a href="photos/moderar/<?=$id?>/2" class="da-button red">
                    <img src="/images/icons/color/cancel.png" alt="">
                    Rechazar
                </a>
                <a href="photos/moderar/<?=$id?>/1" class="da-button green">
                    <img src="/images/icons/color/accept.png" alt="">
                    Aceptar
                </a>
            </p>
        </div>
    </div>
</body>
</html>