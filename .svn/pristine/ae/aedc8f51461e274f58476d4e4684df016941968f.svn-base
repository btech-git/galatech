<h1>Retur Pembelian Barang</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
<!--            <div class="row">
                <?php /*echo CHtml::label('Retur #', false); ?>
                <?php echo CHtml::encode(CHtml::value($purchaseReturn->header, 'number')); ?>
                <?php echo CHtml::error($purchaseReturn->header, 'number');*/ ?>
            </div>-->

            <div class="row">
                <?php echo CHtml::label('Catatan', false); ?>
                <?php echo CHtml::activeTextArea($purchaseReturn->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($purchaseReturn->header, 'note'); ?>
            </div>
        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $purchaseReturn->header,
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
                <?php echo CHtml::error($purchaseReturn->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Pembelian #', ''); ?>
                <?php echo CHtml::activeTextField($purchaseReturn->header, 'purchase_invoice_id', array('readonly' => true, 'onclick' => '$("#purchase-invoice-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#purchase-invoice-dialog").dialog("open"); return false; }')); ?>
                <?php echo CHtml::openTag('span', array('id' => 'purchase_invoice_number')); ?>
                <?php echo CHtml::encode(CHtml::value($purchaseReturn->header, 'purchaseInvoice.number')); ?>
                <?php echo CHtml::closeTag('span'); ?>
                <?php echo CHtml::error($purchaseReturn->header, 'purchase_invoice_id'); ?>

                <?php
                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'purchase-invoice-dialog',
                    // additional javascript options for the dialog plugin
                    'options' => array(
                        'title' => 'Items Invoiced',
                        'autoOpen' => false,
                        'width' => 'auto',
                        'modal' => true,
                    ),
                ));
                ?>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'purchase-grid',
                    'dataProvider' => $purchaseInvoice->search(),
                    'filter' => $purchaseInvoice,
                    'selectionChanged' => 'js:function(id) {
                        $("#' . CHtml::activeId($purchaseReturn->header, 'purchase_invoice_id') . '").val($.fn.yiiGridView.getSelection(id));
                        $("#purchase-invoice-dialog").dialog("close");
                        if ($.fn.yiiGridView.getSelection(id) == "")
                        {
                                $("#purchase_invoice_number").html("");
                                $("#supplier_company").html("");
                        }
                        else
                        {
                                $.ajax({
                                        type: "POST",
                                        dataType: "JSON",
                                        url: "' . CController::createUrl('returnAjaxData', array('id' => $purchaseReturn->header->id)) . '",
                                        data: $("form").serialize(),
                                        success: function(data) {
                                                $("#purchase_invoice_number").html(data.purchase_invoice_number);
                                                $("#supplier_company").html(data.supplier_company);
                                        },
                                });
                        }
                        $.ajax({
                                type: "POST",
                                url: "' . CController::createUrl('addProductAjax', array('id' => $purchaseReturn->header->id, 'nt' => $purchaseReturn->header->is_non_tax)) . '",
                                data: $("form").serialize(),
                                success: function(html) { $("#detail_div").html(html); },
                        });
                    }',
                    'columns' => array(
                        'number',
                        array(
                            'header' => 'Tanggal',
                            'name' => 'date',
                            'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
                        ),
                        array(
                            'header' => 'Supplier',
                            'filter' => CHtml::listData(Supplier::model()->findAll(), 'id', 'company'),
                            'value' => 'CHtml::value($data, "purchaseHeader.supplier.company")',
                        ),
                    ),
                ));
                ?>
                <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Supplier', false); ?>
                <?php echo CHtml::openTag('span', array('id' => 'supplier_company')); ?>
                <?php echo CHtml::encode(CHtml::value($purchaseReturn->header, 'purchaseInvoice.purchaseHeader.supplier.company')); ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Gudang', ''); ?>
                <?php echo CHtml::activeDropDownList($purchaseReturn->header, 'warehouse_id', (TaxConnectionChecking::isCurrentConnectionSecondary()) ? CHtml::listData(Warehouse::model()->findAll(), 'id', 'name') : CHtml::listData(Warehouse::model()->findAll(), 'id', 'name')); ?>
                <?php echo CHtml::error($purchaseReturn->header, 'warehouse_id'); ?>
            </div>

        </div>
    </div>

    <hr />

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('purchaseReturn' => $purchaseReturn, 'error' => $error)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo IdempotentManager::generate(); ?>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
