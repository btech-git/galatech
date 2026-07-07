<?php if ($error === true && count($purchasePayment->details) === 0): ?>
	<p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
	<tr style="background-color: skyblue">
		<th style="text-align: center">TT #</th>
		<th style="text-align: center">Tanggal</th>
		<th style="text-align: center">Nama Akun</th>
		<th style="text-align: center">Total</th>
		<th style="text-align: center">Amount</th>
		<th style="text-align: center">Memo</th>
		<th style="text-align: center"></th>
	</tr>
	<?php foreach ($purchasePayment->details as $i=>$detail): ?>
	<tr style="background-color: azure">
		<td style="width: 15%">
			<?php echo CHtml::activeHiddenField($detail, "[$i]purchase_receipt_header_id"); ?>
			<?php echo CHtml::encode(CHtml::value($detail, 'purchaseReceiptHeader.number')); ?>
		</td>
		<td style="width: 15%">
			<?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($detail, 'purchaseReceiptHeader.date')))); ?>
		</td>
		<td style="text-align: center">
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary()): ?>
				<?php echo CHtml::activeDropDownList($detail, "[$i]account_id", CHtml::listData(Account::model()->findAll($purchasePaymentAccountSecondary), 'id', 'name'), array('empty' => '-- Pilih Akun --')); ?>
			 <?php else: ?>
				<?php echo CHtml::activeDropDownList($detail, "[$i]account_id", CHtml::listData(Account::model()->findAll('account_category_id IN (1, 2, 30, 31, 32)'), 'id', 'name'), array('empty' => '-- Pilih Akun --')); ?>
			 <?php endif; ?>
			<?php echo CHtml::error($detail, 'account_id'); ?>
		</td>
		<td style="width: 15%; text-align: right">
			<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseReceiptHeader.remaining'))); ?>
		</td>
		<td style="text-align: right">
			<?php echo CHtml::activeTextField($detail, "[$i]amount", array(
				'onchange'=>CHtml::ajax(array(
					'type'=>'POST',
					'dataType'=>'JSON',
					'url'=>CController::createUrl('summaryAjaxData', array('id'=>$purchasePayment->header->id, 'index'=>$i)),
					'success'=>'function(data) {
						$("#amount_'.$i.'").html(data.amount);
						$("#total").html(data.total);
						$("#payment").html(data.payment);
						$("#total_payment").html(data.totalPayment);
					}',
				)),
			)); ?>
			<div id="amount_<?php echo $i; ?>" style="text-align: right; font-size: smaller">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?>
			</div>
			<?php echo CHtml::error($detail, 'amount'); ?>
		</td>
		<td style="text-align: center">
			<?php echo CHtml::activeTextField($detail, "[$i]memo", array('size'=>25, 'maxlength'=>50)); ?>
			<?php echo CHtml::error($detail, 'memo'); ?>
		</td>
		<td>
			<?php if ($detail->isNewRecord): ?>
				<?php echo CHtml::button('Delete', array(
					'onclick'=>CHtml::ajax(array(
						'type'=>'POST',
						'url'=>CController::createUrl('removePaymentAjax', array('id'=>$purchasePayment->header->id, 'index'=>$i)),
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
		<td colspan="4" style="font-weight: bold; text-align: right">Total</td>
		<td style="font-weight: bold; text-align: right">
			<span id="payment">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00',ceil($purchasePayment->payment))); ?>
			</span>
		</td>
		<td colspan="2"></td>
	</tr>
</table>
	
<table style="border: 1px solid">
	<tr style="background-color: skyblue;">
		<th style="text-align: center">Nama Akun</th>
		<th style="text-align: center">Jumlah</th>
		<th style="text-align: center">Memo</th>
		<th style="text-align: center"></th>
	</tr>
	<?php foreach ($purchasePayment->extras as $i=>$detail): ?>
	
		<?php $detailAccount= $detail->account(array('scopes' => 'resetScope', 'with' => array( 'accountCategory:resetScope'=> array( 'with'=>array('accountCategoryType:resetScope'))))); ?>
		<tr style="background-color: azure">
			<td>
				<?php echo CHtml::activeHiddenField($detail, "[$i]account_id"); ?>
				<?php echo CHtml::encode(CHtml::value($detailAccount, 'name')); ?>
			</td>
			<td style="text-align: center; width: 15%">
				<?php echo CHtml::activeTextField($detail, "[$i]amount", array('size'=>10, 'maxlength'=>18,
					'onchange'=>CHtml::ajax(array(
						'type'=>'POST',
						'dataType'=>'JSON',
						'url'=>CController::createUrl('AjaxJsonTotalExtra', array('id'=>$purchasePayment->header->id,'index'=>$i)),
						'success'=>'function(data) {
							$("#amount'.$i.'").html(data.amount);
							$("#total_extra").html(data.totalExtra);
							$("#total_payment").html(data.totalPayment);
						}',
					)),
				)); ?>
				<div id="amount<?php echo $i; ?>" style="text-align: left; font-size: smaller">
					<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?>
				</div>
				<?php echo CHtml::error($detail, 'amount'); ?>
			</td>
			
			<td style="text-align: center">
				<?php echo CHtml::activeTextField($detail, "[$i]memo", array('size'=>30, 'maxlength'=>60)); ?>
				<?php echo CHtml::error($detail, 'memo'); ?>
			</td>
			<td>
				<?php if ($detail->isNewRecord): ?>
					<?php echo CHtml::button('Delete', array(
						'onclick'=>CHtml::ajax(array(
							'type'=>'POST',
							'url'=>CController::createUrl('ajaxHtmlRemoveExtras', array('id'=>$purchasePayment->header->id, 'index'=>$i)),
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
		<td style="font-weight: bold; text-align: right">Total</td>
		<td style="font-weight: bold; text-align: center">
			<span id="total_extra">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00',ceil($purchasePayment->totalExtras))); ?>
			</span>
		</td>
		<td colspan="2"></td>
	</tr>
</table>
<table>
	<tr style="background-color: aquamarine">
		<td style="font-weight: bold; text-align: right">Total Pelunasan:</td>
		<td style="font-weight: bold; text-align: right">
				<span id="total">
						<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment, 'totalReceipt'))); ?>
				</span>
		</td>
	</tr>
	<tr style="background-color: aquamarine">
		<td style="font-weight: bold; text-align: right">Pembayaran Lunas:</td>
		<td style="font-weight: bold; text-align: right">
			<span id="total_payment">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchasePayment, 'totalPayment'))); ?>
			</span>
		</td>
	</tr>
</table>
