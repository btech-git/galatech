<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 15% }
        .width1-4 { width: 55% }
		
        .width2-1 { width: 15% }
		.width2-2 { width: 15% }
		.width2-3 { width: 15% }
		.width2-4 { width: 15% }
		.width2-5 { width: 25% }
		.width2-6 { width: 15% }
');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">PT. GALATECH JAYA ABADI</div>
	<div style="font-size: larger">Pengeluaran Giro Pembelian</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">Pengeluaran Giro#</th>
		<th class="width1-2">Issue Date</th>
		<th class="width1-3">Due Date</th>
		<th class="width1-4">Supplier</th>
	</tr>
         <tr id="header2">
			<td colspan="4">
				<table>
					<tr>
						<th class="width2-1">TT #</th>
						<th class="width2-2">Total TT</th>
						<th class="width2-3">Nomor Cek</th>
						<th class="width2-4">Jumlah</th>
						<th class="width2-5">Memo</th>
						<th class="width2-6">Bank</th>
					</tr>
				</table>
			</td>
        </tr>
        
        <?php foreach ($dataProvider->data as $header): ?>
			<tr class="items1">
				<td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
				<td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->issue_date))); ?></td>
				<td class="width1-3"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->due_date))); ?></td>
				<td class="width1-4"><?php echo CHtml::encode(CHtml::value($header, 'supplier.company')); ?></td>
			</tr>
			<tr class="items2">
				<td colspan="4">
					<table>
						<?php foreach ($header->purchaseChequeDetails as $detail): ?>
							<tr>
								<td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'purchaseReceiptHeader.number')); ?></td>
								<td class="width2-2" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseReceiptHeader.totalPurchase'))); ?></td>
								<td class="width2-3" style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'cheque_number')); ?></td>
								<td class="width2-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?></td>
								<td class="width2-5" style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
								<td class="width2-6" style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'account.name')); ?></td>
							</tr>
						<?php endforeach; ?>
						 <tr>
							<td class="width2-1" style="border-top: 1px solid;text-align: right;font-weight:bold">Total</td>
							<td class="width2-2" style="border-top: 1px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $header->totalReceipt)); ?></td>
							<td colspan="2" class="width2-3" style="border-top: 1px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $header->total)); ?></td>
							<td colspan="2" class="width2-4" style="border-top: 1px solid"></td>
						</tr>
					</table>
				</td>
			</tr>
        <?php endforeach; ?>
</table>
