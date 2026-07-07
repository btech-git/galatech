<h1>Invoice Penjualan</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
            <?php if (!empty($invoice->header->id)): ?>
                <div class="row">
                    <?php echo CHtml::label('Invoice #', false); ?>
                    <span id="code_number">
                        <?php echo CHtml::encode(CHtml::value($invoice->header, 'codeNumber')); ?>
                    </span>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($invoice->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($invoice->header, 'note'); ?>
            </div>

        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Tanggal', false); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $invoice->header,
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
                <?php echo CHtml::error($invoice->header, 'date'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Pengiriman #', ''); ?>
                <?php echo CHtml::activeTextField($invoice->header, 'delivery_header_id', array('readonly' => true, 'onclick' => '$("#delivery-header-dialog").dialog("open"); return false;', 'onkeypress' => 'if (event.keyCode == 13) { $("#delivery-header-dialog").dialog("open"); return false; }')); ?>
                <?php echo CHtml::openTag('span', array('id' => 'delivery_header_number')); ?>
                <?php echo CHtml::encode(CHtml::value($invoice->header, 'deliveryHeader.number')); ?>
                <?php echo CHtml::closeTag('span'); ?>
                <?php echo CHtml::error($invoice->header, 'delivery_header_id'); ?>

                <?php
                $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                    'id' => 'delivery-header-dialog',
                    // additional javascript options for the dialog plugin
                    'options' => array(
                        'title' => 'Delivery Items',
                        'autoOpen' => false,
                        'width' => 'auto',
                        'modal' => true,
                    ),
                ));
                ?>
                <?php
                $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'delivery-header-grid',
                    'dataProvider' => $deliveryHeader->searchByInvoice($invoice->header->is_non_tax),
                    'filter' => $deliveryHeader,
                    'selectionChanged' => 'js:function(id) {
                        $("#' . CHtml::activeId($invoice->header, 'delivery_header_id') . '").val($.fn.yiiGridView.getSelection(id));
                        $("#delivery-header-dialog").dialog("close");
                        if ($.fn.yiiGridView.getSelection(id) == "")
                        {
                                $("#delivery_header_number").html("");
                                $("#code_number").html("");
                                $("#customer_company").html("");
                        }
                        else
                        {
                                $.ajax({
                                        type: "POST",
                                        dataType: "JSON",
                                        url: "' . CController::createUrl('deliveryAjaxData') . '",
                                        data: $("form").serialize(),
                                        success: function(data) {
                                                $("#delivery_header_number").html(data.delivery_header_number);
                                                $("#code_number").html(data.code_number);
                                                $("#customer_company").html(data.customer_company);
                                        },
                                });
                        }
                        $.ajax({
                                type: "POST",
                                url: "' . CController::createUrl('showDeliveryAjax') . '",
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
                            'name' => 'customer_id',
                            'filter' => CHtml::listData(Customer::model()->findAll(array('order' => 'company ASC')), 'id', 'company'),
                            'value' => 'CHtml::value($data, "customer.company")',
                        ),
                    ),
                ));
                ?>
                <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::label('Customer', ''); ?>
                <?php echo CHtml::openTag('span', array('id' => 'customer_company')); ?>
                <?php echo CHtml::encode(CHtml::value($invoice->header, 'deliveryHeader.customer.company')); ?>
                <?php echo CHtml::closeTag('span'); ?>
            </div>

            <div class="row">
                <?php echo CHtml::activeLabelEx($invoice->header, 'Penanggung Jawab'); ?>
                <?php echo CHtml::activeDropDownList($invoice->header, 'board_id', CHtml::listData(Board::model()->active()->findAll(), 'id', 'name')); ?>
                <?php echo CHtml::error($invoice->header, 'board_id'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('invoice' => $invoice, 'delivery' => ($invoice->header->deliveryHeader === null) ? DeliveryHeader::model() : $invoice->header->deliveryHeader, 'error' => $error)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo IdempotentManager::generate(); ?>

    <?php echo CHtml::endForm(); ?>

</div><!-- form -->
