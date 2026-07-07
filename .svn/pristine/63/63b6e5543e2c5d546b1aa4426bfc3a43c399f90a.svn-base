<?php if ($error === true && count($receive->details) === 0): ?>
    <p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center">Ukuran</th>
        <th style="text-align: center">Jumlah Pesanan</th>
        <th style="text-align: center">Jumlah Diterima</th>
        <th style="text-align: center">Satuan</th>
        <th style="text-align: center"></th>
    </tr>
    <?php foreach ($receive->details as $i => $detail): ?>
        <tr style="background-color: azure">
            <td style="width: auto">
                <?php echo CHtml::activeHiddenField($detail, "[$i]product_id"); ?>
                <?php echo CHtml::activeHiddenField($detail, "[$i]purchase_detail_id"); ?>
                <?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?>
            </td>
            <td style="text-align: center; width: 10%">
                <?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?>
            </td>
            <td style="text-align:right; width: 15%">
                <?php echo CHtml::hiddenField("quantity_ordered_{$i}", ($quantityOrdered = $detail->getQuantityOrdered($receive->header->purchase_header_id))); ?>
                <span>
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $quantityOrdered)); ?>
                </span>
            </td>
            <td style="text-align:center; width: 15%">
                <?php
                echo CHtml::activeTextField($detail, "[$i]quantity", array(
                    'size' => 5, 'maxlength' => 10,
                    'onchange' => '
                    if (parseInt($(this).val()) > parseInt($("#quantity_ordered_' . $i . '").val())) 
                        $(this).val($("#quantity_ordered_' . $i . '").val()) 
                    ' . CHtml::ajax(array(
                        'type' => 'POST',
                        'dataType' => 'JSON',
                        'url' => CController::createUrl('totalAjaxData', array('id' => $receive->header->id, 'index' => $i)),
                        'success' => 'function(data) {
                            $("#sub_total_quantity").html(data.subTotalQuantity);
                        }',
                    )),
                ));
                ?>
                <?php echo CHtml::error($detail, 'quantity'); ?>
            </td>
            <td style="text-align: center; width: 10%"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
            <td style="width: 5%">
                <?php if ($detail->isNewRecord): ?>
                    <?php echo CHtml::button('Delete', array(
                        'onclick' => CHtml::ajax(array(
                            'type' => 'POST',
                            'url' => CController::createUrl('removeProductAjax', array('id' => $receive->header->id, 'index' => $i)),
                            'update' => '#detail_div',
                        )),
                    )); ?>
                <?php else: ?>
                    <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(
                        ActiveRecord::ACTIVE => 'Active', 
                        ActiveRecord::INACTIVE => 'Inactive'
                    )); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr style="background-color: aquamarine">
        <td colspan="3" style="text-align: right; font-weight: bold">Total Qty</td>
        <td style="text-align: center; font-weight: bold">
            <span id="sub_total_quantity">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $receive->subTotalQuantity)); ?>
            </span>
        </td>
        <td colspan="2"></td>
    </tr>
</table>

