<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 15% }
        .width1-4 { width: 15% }
		.width1-5 { width: 30% }
		
');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">GALATECH</div>
	<div style="font-size: larger">Laporan Jurnal Pembukuan</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">Nomor Transaksi</th>
		<th class="width1-2">Tanggal</th>
		<th class="width1-3">Debit</th>
		<th class="width1-4">Kredit</th>
		<th class="width1-5">Nama Akun</th>
	</tr>
	<tr id="header2">
		<td colspan="5"></td>
	</tr>
	<?php foreach ($dataProvider->data as $header): ?>
		<tr class="items1">
			<td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'transaction_number')); ?></td>
			<td class="width1-2" style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
			<td class="width1-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'debit'))); ?></td>
			<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'credit'))); ?></td>
			<td class="width1-5" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'account.name')); ?></td>
		</tr>
		<tr class="items2">
			<td colspan="5"></td>
		</tr>
	<?php endforeach; ?>
</table>