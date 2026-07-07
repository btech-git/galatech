<?php if ($error === true && count($purchaseCheque->details) === 0): ?>
	<p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
	<tr style="background-color: skyblue">
		<th style="text-align: center">TT #</th>
		<th style="text-align: center">Jumlah TT</th>
		<th style="text-align: center">Nomor Cek</th>
		<th style="text-align: center">Jumlah</th>
		<th style="text-align: center">Memo</th>
		<th style="text-align: center">Bank</th>
		<th></th>
	</tr>
	<?php foreach ($purchaseCheque->details as $i=>$detail): ?>
		<tr style="background-color: azure">
			<td>
				<?php echo CHtml::activeHiddenField($detail, "[$i]purchase_receipt_header_id"); ?>
				<?php echo CHtml::encode(CHtml::value($detail, 'purchaseReceiptHeader.number')); ?>
			</td>
			<td style="text-align: right">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseReceiptHeader.totalPurchase'))); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::activeTextField($detail, "[$i]cheque_number", array('size'=>20, 'maxlength'=>20)); ?>
				<?php echo CHtml::error($detail, 'cheque_number'); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::activeTextField($detail, "[$i]amount", array(
					'onchange'=>CHtml::ajax(array(
						'type'=>'POST',
						'dataType'=>'JSON',
						'url'=>CController::createUrl('summaryAjaxData', array('id'=>$purchaseCheque->header->id, 'index'=>$i)),
						'success'=>'function(data) {
							$("#amount_'.$i.'").html(data.amount);
							$("#total").html(data.total);
						}',
					)),
				)); ?>
				<div id="amount_<?php echo $i; ?>" style="text-align: left; font-size: smaller">
					<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?>
				</div>
				<?php echo CHtml::error($detail, 'amount'); ?>
			</td>
			<td style="text-align: center">
				<?php echo CHtml::activeTextField($detail, "[$i]memo", array('size'=>30, 'maxlength'=>60)); ?>
				<?php echo CHtml::error($detail, 'memo'); ?>
			</td>
			<td style="text-align: center">
				<?php if (TaxConnectionChecking::isCurrentConnectionSecondary()): ?>
					<?php echo CHtml::activeDropDownList($detail, "[$i]account_id", CHtml::listData(Account::model()->findAll($purchaseChequeAccountCategorySecondary), 'id', 'name'), array('empty' => '-- Pilih Bank --')); ?>
				 <?php else: ?>
					<?php echo CHtml::activeDropDownList($detail, "[$i]account_id", CHtml::listData(Account::model()->findAll('account_category_id IN (1,2, 30, 31, 32)'), 'id', 'name'), array('empty' => '-- Pilih Bank --')); ?>
				 <?php endif; ?>
				<?php echo CHtml::error($detail, 'account_id'); ?>
			</td>
			<td>
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
		<td style="font-weight: bold">TOTAL</td>
		<td style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchaseCheque->totalReceipt)); ?></td>
		<td style="font-weight: bold"></td>
		<td style="font-weight: bold; text-align: right">
			<span id="total">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchaseCheque->total)); ?>
			</span>
		</td>
		<td colspan="3"></td>
	</tr>
</table>
