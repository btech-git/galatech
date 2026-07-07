<?php if ($error === true && count($purchaseReceipt->details) === 0): ?>
	<p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
	<tr style="background-color: skyblue">
		<th style="text-align: center; width: 15%">Invoice #</th>
		<th style="text-align: center; width: 15%">Tanggal</th>
		<th style="text-align: center; width: 20%">Supplier</th>
		<th style="text-align: center; width: 15%">Total</th>
		<th style="text-align: center; width: 30%">Memo</th>
		<th></th>
	</tr>
	<?php foreach ($purchaseReceipt->details as $i=>$detail): ?>
		<tr style="background-color: azure">
			<td>
				<?php echo CHtml::activeHiddenField($detail, "[$i]purchase_invoice_id"); ?>
				<?php echo CHtml::encode(CHtml::value($detail, 'purchaseInvoice.number')); ?>
			</td>
			<td>
				<?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($detail, 'purchaseInvoice.date')))); ?>
			</td>
			<td>
				<?php echo CHtml::encode(CHtml::value($detail, 'purchaseInvoice.purchaseHeader.supplier.company')); ?>
			</td>
			<td style="text-align: right">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseInvoice.totalPurchase'))); ?>
			</td>
			<td style="text-align: center">
			<?php echo CHtml::activeTextField($detail, "[$i]memo", array('size'=>30, 'maxlength'=>60)); ?>
			<?php echo CHtml::error($detail, 'memo'); ?>
			</td>
			<td style="width: 5%">
				<?php if ($detail->isNewRecord): ?>
					<?php echo CHtml::button('Delete', array(
						'onclick'=>CHtml::ajax(array(
							'type'=>'POST',
							'url'=>CController::createUrl('ajaxHtmlRemoveDetail', array('index'=>$i)),
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
		<td style="font-weight: bold">TOTAL</td>
		<td style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchaseReceipt->totalInvoice)); ?></td>
		<td></td>
		<td></td>
	</tr>
</table>
