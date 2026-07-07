<?php if ($error === true && count($salesPayment->details) === 0): ?>
	<p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>

<table style="border: 1px solid">
	<tr style="background-color: skyblue">
		<th style="text-align: center">TT #</th>
		<th style="text-align: center">Tanggal</th>
		<th style="text-align: center">Nama Akun</th>
		<th style="text-align: center">Total</th>
		<th style="text-align: center">Jumlah</th>
		<th style="text-align: center">Memo</th>
		<th style="text-align: center"></th>
	</tr>
	<?php foreach ($salesPayment->details as $i=>$detail): ?>
	<tr style="background-color: azure">
		<td style="width: auto">
			<?php echo CHtml::activeHiddenField($detail, "[$i]receipt_header_id"); ?>
			<?php echo CHtml::encode(CHtml::value($detail, 'receiptHeader.number')); ?>
		</td>
		<td>
			<?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($detail, 'receiptHeader.date')))); ?>
		</td>
			<td style="text-align: center">
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary()): ?>
				<?php echo CHtml::activeDropDownList($detail, "[$i]account_id", CHtml::listData(Account::model()->findAll($salePaymentAccountSecondary), 'id', 'name'), array('empty' => '-- Pilih Bank --')); ?>
			 <?php else: ?>
				<?php echo CHtml::activeDropDownList($detail, "[$i]account_id", CHtml::listData(Account::model()->findAll('account_category_id IN (1, 2, 15, 30, 31, 32)'), 'id', 'name'), array('empty' => '-- Pilih Bank --')); ?>
			 <?php endif; ?>
			<?php echo CHtml::error($detail, 'account_id'); ?>
		</td>
		<td style="width: auto">
			<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'receiptHeader.remaining'))); ?>
		</td>
		<td style="text-align: right">
		<?php echo CHtml::activeTextField($detail, "[$i]amount", array(
				'onchange'=>CHtml::ajax(array(
					'type'=>'POST',
					'dataType'=>'JSON',
					'url'=>CController::createUrl('summaryAjaxData', array('id'=>$salesPayment->header->id, 'index'=>$i)),
					'success'=>'function(data) {
						$("#amount_'.$i.'").html(data.amount);
						$("#total_amount").html(data.total);
						$("#amount_paid").html(data.amountPaid);
						$("#total_payment").html(data.totalPayment);
					}',
				)),
			)); ?>
			<div id="amount_<?php echo $i; ?>">
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
						'url'=>CController::createUrl('removePaymentAjax', array('id'=>$salesPayment->header->id, 'index'=>$i)),
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
			<span id="amount_paid">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00',ceil($salesPayment->amountPaid))); ?>
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
	<?php foreach ($salesPayment->extras as $i=>$detail): ?>
	
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
						'url'=>CController::createUrl('AjaxJsonTotalExtra', array('id'=>$salesPayment->header->id,'index'=>$i)),
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
							'url'=>CController::createUrl('ajaxHtmlRemoveExtras', array('id'=>$salesPayment->header->id, 'index'=>$i)),
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
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00',ceil($salesPayment->totalExtras))); ?>
			</span>
		</td>
		<td colspan="2" ></td>
	</tr>
</table>
<table style="border: 1px solid">
	<tr style="background-color: aquamarine">
		<td style="font-weight: bold; text-align: right">Total Penjualan:</td>
		<td style="font-weight: bold; text-align: right">
			<span id="total">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salesPayment, 'totalInvoice'))); ?>
			</span>
		</td>
	</tr>
	<tr style="background-color: aquamarine">
		<td style="font-weight: bold; text-align: right">Total Pembayaran:</td>
		<td style="font-weight: bold; text-align: right">
			<span id="total_payment">
				<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($salesPayment, 'totalPayment'))); ?>
			</span>
		</td>
	</tr>
</table>