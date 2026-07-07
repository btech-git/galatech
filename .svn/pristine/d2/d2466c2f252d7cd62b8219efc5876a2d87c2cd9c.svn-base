<?php
Yii::app()->clientScript->registerCss('_report', '
	
		.width1-1 { width: 33% }
        .width1-2 { width: 33% }
        .width1-3 { width: 33% }
        .width2-1 { width: 16% }
        .width2-2 { width: 16% }
        .width2-3 { width: 16% }
        .width2-4 { width: 16% }
        .width2-5 { width: 16% }
		.width2-6 { width: 16% }
');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">PT. GALATECH</div>
	<div style="font-size: larger">Laporan Tanda terima</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">Tanda Terima penjualan #</th>
		<th class="width1-2">Tanggal</th>
		<th class="width1-3">Customer</th>
		<th class="width1-4">Catatan</th>
	</tr>
	<tr id="header2">
		<td colspan="5">
			<table>
				<tr>
					<th class="width2-1">Invoice #</th>
					<th class="width2-2">Tanggal</th>
					<th class="width2-3">Customer</th>
					<th class="width2-4">Total(Rp)</th>
					<th class="width2-5">Memo</th>
				</tr>
			</table>
		</td>
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
						<?php foreach ($header->receiptDetails as $detail): ?>
							<tr>
								<td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.codeNumber')); ?></td>
								<td class="width2-2"><?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.date')); ?></td>
								<td class="width2-3"><?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.deliveryHeader.customer.company')); ?></td>
								<td class="width2-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'invoiceHeader.deliveryHeader.grandTotal'))); ?></td>
								<td class="width2-5" style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
							</tr>
						<?php endforeach; ?>
						<tr>
							<td class="width2-1" style="border-top: 1px solid"></td>
							<td class="width2-2" style="border-top: 1px solid"></td>
							<td class="width2-3" style="border-top: 1px solid;text-align: right;font-weight:bold">Total</td>
							<td class="width2-4" style="border-top: 1px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $header->totalInvoice)); ?></td>
							<td class="width2-5" style="border-top: 1px solid"></td>
						</tr>
					</table>
				</td>
			</tr>
        <?php endforeach; ?>
</table>
