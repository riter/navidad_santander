<!-- jQuery-UI JavaScript Files -->
<script type="text/javascript" src="/plugins/validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/clients/add.js"></script>

<?php
    $action = $this->request->params['action'];
?>

<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/pencil.png" alt="" />
            Formulario Usuarios
        </span>
    </div>
    <div class="da-panel-content">
        <?= $this->Form->create('Client', array('id' => 'form_cliente','class' => 'da-form', 'url' => array('controller' => 'clients', 'action' => $action))); ?>
        <div class="da-form-row">
            <label>Nombre <span class="required"><span>*</span></label>
            <div class="da-form-item">
                <?= $this->Form->input('nombre', array('label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="da-form-row">
            <label>Email <span class="required"><span>*</span></label>
            <div class="da-form-item">
                <?= $this->Form->input('email', array('type'=>'text','label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="da-form-row">
            <label>Telefono <span class="required"></label>
            <div class="da-form-item">
                <?= $this->Form->input('telefono', array('label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="da-button-row">
            <a href="<?= $this->Html->url(array('controller' => 'clients', 'action' => 'index'))?>"><input type="button" value="Cancelar" class="da-button orange large left"/></a>
            <input type="submit" value="Guardar" class="da-button green large"/>
        </div>
        </form>
    </div>
</div>