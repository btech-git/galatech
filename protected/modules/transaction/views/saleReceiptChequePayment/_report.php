<?php
Yii::app()->clientScript->registerCss('_report', '
	
		.width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 30% }
		.width1-4 { width: 40% }
		
        .width2-1 { width: 10% }
        .width2-2 { width: 15% }
        .width2-3 { width: 15% }
		.width2-4 { width: 10% }
		.width2-5 { width: 10% }
		.width2-6 { width: 10% }
		.width2-7 { width: 30% }
		
		.width3-1 { width: 20% }
        .width3-2 { width: 20% }
        .width3-3 { width: 20% }
		.width3-4 { width: 40% }
');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">PT. GALATECH JAYA ABADI</div>
	<div style="font-size: larger">Laporan Tanda Terima Penjualan</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">Tanda Terima #</th>
		<th class="width1-2">Tanggal</th>
		<th class="width1-3">Customer</th>
		<th class="width1-4">Catatan</th>
	</tr>
	<tr id="header2">
		<td colspan="7"></td>
	</tr>
        
        <?php foreach ($dataProvider->data as $header): ?>
			<tr class="items1">
				<td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
				<td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
				<td class="width1-3"><?php echo CHtml::encode(CHtml::value($header, 'customer.company')); ?></td>
				<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
			</tr>
			<tr class="items2">
				<td colspan="5">
					<table>
						<?php foreach ($header->cheques as $cheque): ?>
							<tr>
								<td class="width2-1"><?php echo CHtml::encode(CHtml::value($cheque, 'number')); ?></td>
								<td class="width2-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($cheque->receive_date))); ?></td>
								<td class="width2-3"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($cheque->due_date))); ?></td>
								<td class="width2-4"><?php echo CHtml::encode(CHtml::value($cheque, 'cheque_number')); ?></td>
								<td class="width2-5"><?php //echo CHtml::encode(CHtml::value($cheque, 'bank')); ?></td>
								<td class="width2-6" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($cheque, 'amount'))); ?></td>
								<td class="width2-7" style="text-align: right"><?php echo CHtml::encode(CHtml::value($cheque, 'memo')); ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</td>
			</tr>
			<tr class="items2">
				<td colspan="5">
					<table>
						<?php foreach ($header->salesPaymentDetailRevs as $salesPayment): ?>
							<tr>
								<td class="width3-1"><?php echo CHtml::encode(CHtml::value($salesPayment, 'salesPaymentHeaderRev.number')); ?></td>
								<td class="width3-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($salesPayment->salesPaymentHeaderRev->date))); ?></td>
								<td class="width3-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salesPayment, 'payment'))); ?></td>
								<td class="width3-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($salesPayment, 'salesPaymentHeaderRev.note')); ?></td>
							</tr>
						<?php endforeach; ?>
					</table>
				</td>
			</tr>
        <?php endforeach; ?>
</table>
