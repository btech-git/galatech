<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 15% }
        .width1-4 { width: 10% }
        .width1-5 { width: 15% }
		.width1-6 { width: 15% }
		.width1-7 { width: 15% }
');
?>

<div style="font-weight: bold; text-align: center">
        <div style="font-size: larger">PT. GALATECH</div>
        <div style="font-size: larger">Faktur Pembelian</div>
        <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
        <tr id="header1">
                <th class="width1-1">Penerimaan Faktur #</th>
                <th class="width1-2">Tanggal</th>
                <th class="width1-3">Pembelian #</th>
				<th class="width1-4">Faktur #</th>
                <th class="width1-5">Supplier</th>
				<th class="width1-6">Jumlah</th>
                <th class="width1-7">Catatan</th>
        </tr>
        <tr id="header2">
                <td colspan="7"></td>
        </tr>
        
        <?php foreach ($dataProvider->data as $header): ?>
                <tr class="items1">
                        <td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
                        <td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
                        <td class="width1-3"><?php echo CHtml::encode(CHtml::value($header, 'purchaseHeader.number')); ?></td>
						<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'reference')); ?></td>
                        <td class="width1-5" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, ($header->is_non_tax) ? 'purchaseHeader.supplier.company' : 'purchaseHeader.supplier.company')); ?></td>
                        <td class="width1-6" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'total'))); ?></td>
						<td class="width1-7" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
						
                </tr>
                <tr class="items2">
                        <td colspan="7"></td>
                </tr>
        <?php endforeach; ?>
</table>
