<h1>Penjualan Asset</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <div class="row">
                <?php echo CHtml::label('Penjualan #', false); ?>
                <?php echo CHtml::encode(CHtml::value($salesAsset->header, 'number')); ?>
                <?php echo CHtml::error($salesAsset->header, 'number'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $salesAsset->header,
                    'attribute' => 'date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($salesAsset->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Customer', ''); ?>
                <?php echo CHtml::activeTextField($salesAsset->header, 'customer', array('size' => 20, 'maxLength' => 60)); ?>
                <?php echo CHtml::error($salesAsset->header, 'customer'); ?>
            </div>
        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($salesAsset->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($salesAsset->header, 'note'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div class="row buttons">
        <?php
        echo CHtml::button('Tambah Data Barang', array(
            'onclick' => CHtml::ajax(array(
                'type' => 'POST',
                'url' => CController::createUrl('AddItemAjax', array('id' => $salesAsset->header->id)),
                'update' => '#detail_div',
            )),
        ));
        ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('salesAsset' => $salesAsset, 'error' => $error)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo IdempotentManager::generate(); ?>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
