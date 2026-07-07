<?php if ($error === true && count($salesReturn->details) === 0): ?>
    <p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center">Ukuran</th>
        <th style="text-align: center">Jumlah Terjual</th>
        <th style="text-align: center">Jumlah Retur</th>
        <th style="text-align: center">Satuan</th>
        <th style="text-align: center">Harga Satuan</th>
        <th style="text-align: center">Total</th>
        <th style="text-align: center"></th>
    </tr>
    <?php foreach ($salesReturn->details as $i => $detail): ?>
        <tr style="background-color: azure">
            <td style="width: auto">
                <?php echo CHtml::activeHiddenField($detail, "[$i]product_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?>
            </td>
            <td style="text-align: center; width: 10%">
                <?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?>
            </td>
            <td style="text-align:right; width: 10%">
                <?php echo CHtml::hiddenField("quantity_sold_{$i}", ($quantitySold = $detail->getQuantitySold($salesReturn->header->invoice_header_id))); ?>
                <span><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $quantitySold)); ?></span>
            </td>
            <td style="text-align:center; width: 10%">
                <?php
                echo CHtml::activeTextField($detail, "[$i]quantity", array('size' => 7, 'maxLength' => 20,
                    'onchange' => 'if (parseInt($(this).val()) > parseInt($("#quantity_sold_' . $i . '").val())) $(this).val($("#quantity_sold_' . $i . '").val());' .
                    CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('totalAjaxData', array('id' => $salesReturn->header->id, 'index' => $i)),
                        'success' => 'function(data) {
							$("#total_' . $i . '").html(data.total);
							$("#sub_total").html(data.subTotal);
							$("#tax").html(data.tax);
							$("#grand_total").html(data.grandTotal);
                                                        $("#sub_total_quantity").html(data.subTotalQuantity);
						}',
                    )),
                ));
                ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>
            <td style="text-align: center; width: 10%">
                <?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?>
                <?php echo CHtml::error($detail, 'product.unit.name'); ?>
            </td>
            <td style="text-align:right; width: 10%">
                <?php echo CHtml::activeHiddenField($detail, "[$i]unit_price"); ?>
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unitPrice'))); ?>
                <?php //echo CHtml::error($detail, 'unit_price');  ?>
            </td>
            <td style="text-align:right; width: 15%">
                <span id="total_<?php echo $i; ?>">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
                </span>
            </td>
            <td style="width: 5%">
                <?php if ($detail->isNewRecord): ?>
                    <?php
                    echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('removeProductAjax', array('id' => $salesReturn->header->id, 'index' => $i)),
                            'update' => '#detail_div',
                        )),
                    ));
                    ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td>Total Qty</td>
        <td style="text-align: right">
            <span id="sub_total_quantity">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $salesReturn->subTotalQuantity)); ?>
            </span>
        </td>
        <td></td>
        <td>Sub Total:</td>
        <td style="text-align: right">
            <span id="sub_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->subTotal)); ?>
            </span>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <?php echo CHtml::activeLabelEx($salesReturn->header, 'tax', array('style' => 'display: inline')); ?>
            <?php
            echo CHtml::activeTextField($salesReturn->header, 'tax', array('size' => 2, 'maxlength' => 2,
                'onchange' => CHtml::ajax(array(
                    'type' => 'POST',
                    'dataType' => 'JSON',
                    'url' => CController::createUrl('taxTotalAjaxData', array('id' => $salesReturn->header->id)),
                    'success' => 'function(data) {
						$("#tax").html(data.tax);
						$("#grand_total").html(data.grandTotal);
					}',
                )),
            ));
            ?>
            <?php echo '%'; ?>
        </td>
        <td style="text-align: right">
            <span id="tax">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->calculatedTax)); ?>
            </span>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Ongkos Kirim:</td>
        <td style="text-align: right">
            <?php
            echo CHtml::activeTextField($salesReturn->header, 'shipping_fee', array('size' => 10, 'maxLength' => 20,
                'onchange' => CHtml::ajax(array(
                    'type' => 'POST',
                    'dataType' => 'JSON',
                    'url' => CController::createUrl('grandTotalAjaxData', array('id' => $salesReturn->header->id)),
                    'success' => 'function(data) {
						$("#grand_total").html(data.grandTotal);
					}',
                )),
            ));
            ?>
            <?php echo CHtml::error($salesReturn->header, 'shipping_fee'); ?>
        </td>
        <td></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Grand Total:</td>
        <td style="text-align: right">
            <span id="grand_total">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->grandTotal)); ?>
            </span>
        </td>
        <td></td>
    </tr>
</table>
