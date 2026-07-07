<?php
Yii::app()->clientScript->registerCss('_report', '
	.width1-1 { width: 15% }
	.width1-2 { width: 15% }
	.width1-3 { width: 15% }
	.width1-4 { width: 20% }
	.width1-5 { width: 20% }
	.width1-6 { width: 20% }
        
');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">PT. GALATECH</div>
	<div style="font-size: larger">Laporan Uang Muka Customer</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">Uang Muka #</th>
		<th class="width1-2">Tanggal</th>
		<th class="width1-3">Customer</th>
		<th class="width1-4">Jumlah</th>
		<th class="width1-5">Pajak</th>
		<th class="width1-6">Catatan</th>
	</tr>
	<tr id="header2">
		<td colspan="6"></td>
	</tr>
        
	<?php foreach ($dataProvider->data as $header): ?>
		<tr class="items1">
			<td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
			<td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
			<td class="width1-3" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, ($header->is_non_tax) ? 'customer.name' : 'customer.company')); ?></td>
			<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->amount)); ?></td>
			<td class="width1-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->tax)); ?></td>
			<td class="width1-6" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
		</tr>

	<?php endforeach; ?>
</table>