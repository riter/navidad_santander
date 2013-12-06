<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro</title>
    <link rel="stylesheet" href="/frontend_css/normalize.css">
    <link rel="stylesheet" href="/frontend_css/registro.css">

    <!-- Add jQuery library -->
    <script type="text/javascript" src="/frontend_js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/plugins/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/js/registers/index.js"></script>


</head>
<body>
<section>
    <div class="registro">
        <h2>¿Quién eres?</h2>
        <p>Para participar necesitamos tus datos.</p>
        <p>Solo utilizaremos para conectarte en caso de que resultes ganador.</p>
        <?= $this->Form->create('Client', array('id' => 'form_cliente', 'url' => array('controller' => 'registers', 'action' => 'index'),'target'=>'_parent')); ?>
            <ul>
                <!--<li><input type="text" placeholder="Nombres y apellidos"></li>-->
                <li><?= $this->Form->input('nombre', array('label' => false, 'div' => false,'placeholder'=>'Nombres y apellidos')); ?></li>
                <!--<li><input type="text" placeholder="Email"></li>-->
                <li><?= $this->Form->input('email', array('type'=>'text','label' => false, 'div' => false,'placeholder'=>"Email")); ?></li>
                <!--<li><input type="text" placeholder="Teléfono"><span>*</span></li>-->
                <li><?= $this->Form->input('telefono', array('label' => false, 'div' => false,'placeholder'=>"Teléfono")); ?><span>*</span></li>
                <li>
                    <p>*Datos Opcionales</p>
                    <p id="msg" style="display: none">*Datos Opcionales</p>
                </li>
                <li><input type="submit" value="Registrarme" id="registro"></li>
            </ul>
        </form>
    </div>
    <!-- <img class="regalo" src="images/regalo.png" alt="regalo"> -->
</section>
</body>
</html>