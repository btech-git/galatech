<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 30% }
		.width1-4 { width: 40% }
        
        
        .width2-1 { width: 15% }
        .width2-2 { width: 15% }
        .width2-3 { width: 20% }
		.width2-4 { width: 50% }
');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">PT. GALATECH</div>
	<div style="font-size: larger">Laporan Tanda Terima Pembelian Barang</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">TT Pembelian #</th>
		<th class="width1-2">Tanggal</th>
		<th class="width1-3">Supplier</th>
		<th class="width1-4">Catatan</th>
	</tr>
        <tr id="header2">
			<td colspan="4">
				<table>
					<tr>
						<th class="width2-1">Nomor  Faktur</th>
						<th class="width2-2">Tanggal</th>
						<th class="width2-3">Total</th>
						<th class="width2-4">Memo</th>
					</tr>
				</table>
			</td>
        </tr>
        <?php foreach ($dataProvider->data as $header): ?>
			<tr class="items1">
				<td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
				<td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
				<td class="width1-3"><?php echo CHtml::encode(CHtml::value($header, 'supplier.company')); ?></td>
				<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
			</tr>
			<tr class="items2">
				<td colspan="4">
					<table>
						<?php foreach ($header->purchaseReceiptDetails as $detail): ?>
							<tr>
								<td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'purchaseInvoice.number')); ?></td>
								<td class="width2-2"><?php echo CHtml::encode(CHtml::value($detail, 'purchaseInvoice.date')); ?></td>
								<td class="width2-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseInvoice.totalPurchase'))); ?></td>
								<td class="width2-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
							</tr>
						<?php endforeach; ?>
						 <tr>
							<td class="width2-1" style="border-top: 1px solid"></td>
							<td class="width2-2" style="border-top: 1px solid;text-align: right;font-weight:bold">Total</td>
							<td class="width2-3" style="border-top: 1px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $header->totalPurchase)); ?></td>
							<td class="width2-4" style="border-top: 1px solid"></td>
						</tr>
					</table>
				</td>
			</tr>
		<?php endforeach; ?>
</table>