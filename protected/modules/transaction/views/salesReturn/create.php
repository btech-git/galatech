<h1>Retur Penjualan Barang</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
<!--            <div class="row">
                <?php /*echo CHtml::label('Retur #', false); ?>
                <?php echo CHtml::encode(CHtml::value($salesReturn->header, 'number')); ?>
                <?php echo CHtml::error($salesReturn->header, 'number');*/ ?>
            </div>-->

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($salesReturn->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($salesReturn->header, 'note'); ?>
            </div>
        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $salesReturn->header,
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
                <?php echo CHtml::error($salesReturn->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Invoice #', ''); ?>
                <?php echo CHtml::activeTextField($salesReturn->header, 'invoice_header_id', array('readonly' => true, 'onclick' => '$("#invoice-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#invoice-header-dialog").dialog("open"); return false; }')); ?>
                <?php echo CHtml::openTag('span', array('id' => 'invoice_header_number')); ?>
                <?php echo CHtml::encode(CHtml::value($salesReturn->header, 'invoiceHeader.number')); ?>
                <?php echo CHtml::closeTag('span'); ?>
                <?php echo CHtml::error($salesReturn->header, 'invoice_header_id'); ?>

                <?php
                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'invoice-header-dialog',
                    // additional javascript options for the dialog plugin
                    'options' => array(
                        'title' => 'Invoice',
                        'autoOpen' => false,
                        'width' => 'auto',
                        'modal' => true,
                    ),
                ));
                ?>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'invoice-header-grid',
                    'dataProvider' => $invoiceHeader->search(), //BySalesReturn(),
                    'filter' => $invoiceHeader,
                    'selectionChanged' => 'js:function(id) {
                        $("#' . CHtml::activeId($salesReturn->header, 'invoice_header_id') . '").val($.fn.yiiGridView.getSelection(id));
                        $("#invoice-header-dialog").dialog("close");
                        if ($.fn.yiiGridView.getSelection(id) == "")
                        {
                                $("#invoice_header_number").html("");
                                $("#customer_company").html("");

                        }
                        else
                        {
                                $.ajax({
                                        type: "POST",
                                        dataType: "JSON",
                                        url: "' . CController::createUrl('returnAjaxData', array('id' => $salesReturn->header->id)) . '",
                                        data: $("form").serialize(),
                                        success: function(data) {
                                                $("#invoice_header_number").html(data.invoice_header_number);
                                                $("#customer_company").html(data.customer_company);
                                        },
                                });
                        }
                        $.ajax({
                                type: "POST",
                                url: "' . CController::createUrl('addProductAjax', array('id' => $salesReturn->header->id, 'nt' => $salesReturn->header->is_non_tax)) . '",
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
                            'name' => 'deliveryHeader.customer.company',
                            'filter' => CHtml::listData(Customer::model()->findAll(), 'id', 'company'),
                            'value' => 'CHtml::value($data, "deliveryHeader.customer.company")',
                        ),
                    ),
                ));
                ?>
                <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Customer', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'customer_company')); ?>
                <?php echo CHtml::encode(CHtml::value($salesReturn->header, 'invoiceHeader.deliveryHeader.customer.company')); ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Gudang', ''); ?>
                <?php echo CHtml::activeDropDownList($salesReturn->header, 'warehouse_id', (TaxConnectionChecking::isCurrentConnectionSecondary()) ? CHtml::listData(Warehouse::model()->findAll(), 'id', 'name') : CHtml::listData(Warehouse::model()->findAll(), 'id', 'name')); ?>
                <?php echo CHtml::error($salesReturn->header, 'warehouse_id'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('salesReturn' => $salesReturn, 'error' => $error)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo IdempotentManager::generate(); ?>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
