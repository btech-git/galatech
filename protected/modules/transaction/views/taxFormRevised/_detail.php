<?php if ($error === true && count($taxFormRevised->details) === 0): ?>
        <p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
        <tr style="background-color: skyblue">
                <th style="text-align: center">Nama Aset</th>
                <th style="text-align: center">Jumlah</th>
                <th style="text-align: center"></th>
        </tr>
        <?php foreach ($taxFormRevised->details as $i=>$detail): ?>
        <tr style="background-color: azure">
                <td style="width: auto">
                        <?php echo CHtml::activeTextField($detail, "[$i]name"); ?>
                        <?php echo CHtml::error($detail, 'name'); ?>
                </td>
                <td style="text-align: center; width: 10%">
                        <?php echo CHtml::activeTextField($detail, "[$i]price"); ?>
                        <?php echo CHtml::error($detail, 'price'); ?>
                </td>
                <td style="width: 5%">
                        <?php if ($detail->isNewRecord): ?>
                                <?php echo CHtml::button('Delete', array(
                                        'onclick'=>CHtml::ajax(array(
                                                'type'=>'POST',
                                                'url'=>CController::createUrl('removeProductAjax', array('id'=>$taxFormRevised->header->id, 'index'=>$i)),
                                                'update'=>'#detail_div',
                                        )),
                                )); ?>
                        <?php else: ?>
                                <?php echo CHtml::activeDropDownList($detail, "[$i]is_inactive", array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
                        <?php endif; ?>
                </td>
        </tr>
        <?php endforeach; ?>
</table>