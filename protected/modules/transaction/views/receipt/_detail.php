<?php if ($error === true && count($receipt->details) === 0): ?>
	<p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
	<tr style="background-color: skyblue">
		<th style="text-align: center; width: 15%">Invoice #</th>
		<th style="text-align: center; width: 15%">Tanggal</th>
		<th style="text-align: center; width: 25%">Customer</th>
		<th style="text-align: center; width: 15%">Total(Rp)</th>
		<th style="text-align: center; width: 25%">Memo</th>
		<th></th>
	</tr>
	<?php foreach ($receipt->details as $i=>$detail): ?>
		<tr style="background-color: azure">
			<td>
				<?php echo CHtml::activeHiddenField($detail, "[$i]invoice_header_id"); ?>
				<?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.codeNumber')); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($detail, 'invoiceHeader.date')))); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.deliveryHeader.customer.company')); ?>
			</td>
			<td style="text-align: right">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'invoiceHeader.deliveryHeader.grandTotalPayment'))); ?>
			</td>
			<td>
				<?php echo CHtml::activeTextField($detail, "[$i]memo", array('size' => 30, 'maxLength' => 100)); ?>
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
		<td style="text-align: right; font-weight: bold">Total</td>
		<td style="text-align: right; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($receipt, 'totalInvoice'))); ?></td>
		<td></td>
		<td></td>
	</tr>
</table>
