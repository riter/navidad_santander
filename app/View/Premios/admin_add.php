<!-- jQuery-UI JavaScript Files -->
<script type="text/javascript" src="/plugins/validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/premios/add.js"></script>

<?php
    $action = $this->request->params['action'];
?>

<div class="da-panel collapsible">
    <div class="da-panel-header">
        <span class="da-panel-title">
            <img src="/images/icons/black/16/pencil.png" alt="" />
            Formulario Premios
        </span>
    </div>
    <div class="da-panel-content">
        <?= $this->Form->create('Premio', array('id' => 'form_premio','class' => 'da-form', 'url' => array('controller' => 'premios', 'action' => $action))); ?>
        <div class="da-form-row">
            <label>Descipción <span class="required">*</span></label>
            <div class="da-form-item">
                <?= $this->Form->input('descripcion', array('label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="da-form-row">
            <label>Premio <span class="required">*</span></label>
            <div class="da-form-item default">
                <? $icon_premios=$this->santander->getIconPremios();
                echo $this->Form->input('imagen', array('options'=>$icon_premios,'label' => false, 'div' => false,'empty'=>'Iconos Premios'));?>
            </div>
            <div style="margin-left: 136px">
                <img src="" alt="Imagen Premio" style="display:none" id="img"/>
            </div>
        </div>
        <div class="da-form-row">
            <label>Posicion <span class="required">*</span></label>
            <div class="da-form-item">
                <?= $this->Form->input('posicion', array('type'=>'text','label' => false, 'div' => false)); ?>
                <p>Posicion Inicial 1 de izquierda a derecha</p>
            </div>
        </div>
        <div class="da-button-row">
            <a href="<?= $this->Html->url(array('controller' => 'premios', 'action' => 'index'))?>"><input type="button" value="Cancelar" class="da-button orange large left"/></a>
            <input type="submit" value="Guardar" class="da-button green large"/>
        </div>
        </form>
    </div>
</div>