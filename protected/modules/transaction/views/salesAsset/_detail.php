<?php if ($error === true && count($salesAsset->details) === 0): ?>
        <p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
        <tr style="background-color: skyblue">
                <th style="text-align: center">Nama Asset</th>
                <th style="text-align: center">Jumlah</th>
                <th style="text-align: center">Harga Satuan</th>
                <th style="text-align: center">Total</th>
                <th style="text-align: center"></th>
        </tr>
        <?php foreach ($salesAsset->details as $i=>$detail): ?>
        <tr style="background-color: azure">
                <td style="width: auto">
                        <?php echo CHtml::activeTextField($detail, "[$i]asset_name", array('size'=>60, 'maxLength'=>60)); ?>
                        <?php echo CHtml::error($detail, 'asset_name'); ?>
                </td>
                
                <td style="text-align: center; width: 10%">
                        <?php echo CHtml::activeTextField($detail, "[$i]quantity", array('size'=>7, 'maxLength'=>20,
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'dataType'=>'JSON',
                                        'url'=>CController::createUrl('totalAjaxData', array('id'=>$salesAsset->header->id, 'index'=>$i)),
                                        'success'=>'function(data) {
                                                $("#total_'.$i.'").html(data.total);
                                                $("#sub_total").html(data.subTotal);
                                        }',
                                )),
                        )); ?>
                        <?php echo CHtml::error($detail, 'quantity'); ?>
                </td>
                
                <td style="text-align: center; width: 15%">
                        <?php echo CHtml::activeTextField($detail, "[$i]unit_price", array('size'=>10, 'maxLength'=>20,
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'dataType'=>'JSON',
                                        'url'=>CController::createUrl('totalAjaxData', array('id'=>$salesAsset->header->id, 'index'=>$i)),
                                        'success'=>'function(data) {
                                                $("#unit_price_'.$i.'").html(data.unitPrice);
                                                $("#total_'.$i.'").html(data.total);
                                                $("#sub_total").html(data.subTotal);
                                        }',
                                )),
                        )); ?>
                        <div id="unit_price_<?php echo $i; ?>" style="text-align: left; font-size: smaller">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?>
                        </div>
                        <?php echo CHtml::error($detail, 'unit_price'); ?>
                </td>
                
                <td style="text-align: right; width: 15%">
                        <span id="total_<?php echo $i; ?>">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'total'))); ?>
                        </span>
                </td>
                <td style="width: 5%">
                        <?php if ($detail->isNewRecord): ?>
                                <?php echo CHtml::button('Delete', array(
                                        'onclick'=>CHtml::ajax(array(
                                                'type'=>'POST',
                                                'url'=>CController::createUrl('removeProductAjax', array('id'=>$salesAsset->header->id, 'index'=>$i)),
                                                'update'=>'#detail_div',
                                        )),
                                )); ?>
                        <?php else: ?>
                                <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                        <?php endif; ?>
                </td>
        </tr>
        <?php endforeach; ?>
        <tr style="background-color: aquamarine">
                <td></td>
                <td></td>
                <td style="font-weight:bold">Total:</td>
                <td style="text-align: right; font-weight: bold">
                        <span id="sub_total">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesAsset->subTotal)); ?>
                        </span>
                </td>
                <td></td>
        </tr>
</table>