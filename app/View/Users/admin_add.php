<!-- Contenido Add users -->
<!-- jQuery-UI JavaScript Files -->
<script type="text/javascript" src="/jui/js/jquery-ui-1.8.20.min.js"></script>
<script type="text/javascript" src="/jui/js/jquery.ui.timepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="/jui/css/jquery.ui.all.css" media="screen" />

<!-- DataTables Plugin -->
<?php echo $this->Html->script('/plugins/datatables/jquery.dataTables.min'); ?>

<!-- Validation Plugin -->
<script type="text/javascript" src="/plugins/validate/jquery.validate.min.js"></script>

<?php
    $action = $this->request->params['action'];
?>
<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/pencil.png" alt="" />
            Formulario Usuario
        </span>
    </div>
    <div class="da-panel-content">
        <?php echo $this->Form->create('User', array('id' => 'form_users', 'class' => 'da-form', 'url' => array('controller' => 'users', 'action' => $action)));
        ?>
        <div class="da-form-row">
            <label>Login <span class="required">*</span></label>
            <div class="da-form-item default">
                <?php echo $this->Form->input('username', array('id' => 'username','label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="da-form-row">
            <label>Password</label>
            <div class="da-form-item default">
                <?= $this->Form->input('password', array('label' => false, 'div' => false));?>
            </div>
        </div>
        <div class="da-form-row">
            <label>Confirmar Password </label>
            <div class="da-form-item default">
                <?= $this->Form->input('confirm_password', array('type' => 'password', 'label' => false, 'div' => false));?>
            </div>
        </div>
        <div class="da-form-row">
            <label>Role</label>
            <div class="da-form-item small">
                <?php echo $this->Form->input('role', array('label' => false, 'div' => false, 'options' => array('admin' => 'Admin')));?>
            </div>
        </div>
        <div class="da-button-row">
            <a href="/admin/users"><input type="button" value="Cancelar" class="da-button orange large left" /></a>
            <input type="submit" value="Guardar" class="da-button green large" />
        </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="/js/user/add.js"></script>