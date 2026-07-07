<?php
Yii::app()->clientScript->registerScript('memo', '
        $("#header").addClass("hide");
        $("#mainmenu").addClass("hide");
        $(".breadcrumbs").addClass("hide");
        $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
        .hcolumn1 { width: 50% }
        .hcolumn2 { width: 50% }
        
        .hcolumn1header { width: 35% }
        .hcolumn1value { width: 65% }
        .hcolumn2header { width: 35% }
        .hcolumn2value { width: 65% }
        
        .sig1 { width: 25% }
        .sig2 { width: 50% }
        .sig3 { width: 25% }
');
?>

<div id="memoheader">
	<div style="font-size: larger"><?php echo $salesPaymentHeaderText; ?></div>
	<div style="font-size: larger">NOTA PENERIMAAN BANK</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Pelunasan #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($salesPayment, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salesPayment, 'date')))); ?></div>
				</div>
			</div>
		</div>
		<div class="divtablecell hcolumn2">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn2header" style="font-weight: bold">Customer</div>
					<div class="divtablecell info hcolumn2value"><?php echo $salesPaymentCustomer; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<br />

<table class="memo">
	<tr id="theader">
		<th>Tanda Terima Penjualan</th>
		<th>Tanggal</th>
		<th>Nama Akun</th>
		<th>Total</th>
		<th>Jumlah</th>
		<th>Memo</th>
	</tr>
        <?php foreach ($salesPayment->salesPaymentDetailRevs as $i=>$detail): ?>
			<tr class="titems">
				<td><?php echo CHtml::encode(CHtml::value($detail, 'receiptHeader.number')); ?></td>
				<td><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd MMMM yyyy', strtotime(CHtml::value($detail, 'receiptHeader.date')))); ?></td>
				<td><?php echo CHtml::encode(CHtml::value($detail, 'account.name')); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'receiptHeader.totalInvoice'))); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?></td>
				<td><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
			</tr>
        <?php endforeach; ?>
        <?php for ($j = 6, $i = $i % $j + 1; $j > $i; $j--): ?>
			<tr class="titems">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
        <?php endfor; ?>
        <tr>
			<td style="border-top: 2px solid; font-weight: bold; text-align: right" colspan="3" >TOTAL</td>
			<td style="border-top: 2px solid; font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($salesPayment, 'totalInvoice')))); ?></td>
			<td style="border-top: 2px solid; font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($salesPayment, 'amountPaid')))); ?></td>
			<td style="border-top: 2px solid"></td>
		</tr>
</table>

<table class="memo">
	<tr id="theader">
		<th>Nama Akun</th>
		<th>Jumlah</th>
		<th>Memo</th>
	</tr>
	<?php foreach ($salesPayment->salesPaymentExtras as $i => $extra): ?>
		<tr class="titems">
			<td style="width: 30%;"><?php echo CHtml::encode(CHtml::value($extra, 'account.name')); ?></td>
			<td style="width: 20%; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($extra, 'amount'))); ?></td>
			<td><?php echo CHtml::encode(CHtml::value($extra, 'memo')); ?></td>
		</tr>
	<?php endforeach; ?>
	<tr>
		<td style="border-top: 2px solid; text-align: right; font-weight: bold">TOTAL</td>
		<td style="border-top: 2px solid; text-align: right; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($salesPayment, 'totalExtras')))); ?></td>
		<td style="border-top: 2px solid"></td>
	</tr>
</table>

</br>

<div>
	Catatan: 
	<?php echo CHtml::encode(CHtml::value($salesPayment, 'note')); ?>
</div>

</br>

<div>
	Total Pembayaran: Rp 
	<?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', (CHtml::value($salesPayment, 'totalPayment')))); ?>
</div>

</br>

<div style="text-transform: capitalize">
	Terbilang:
	<?php echo CHtml::encode(NumberWord::numberName(floor(CHtml::value($salesPayment, 'totalPayment')))); ?>
	rupiah
</div>

<br />

<div class="memosig">
	<div class="divtable">
		<div class="divtablecell sig1">
			<div>Dibuat</div>
			<br/><br/><br/>
			<div>(Finance)</div>
		</div>
		<div class="divtablecell sig3">
			<div>Diketahui</div>
			<br/><br/><br/>
			<div>(Pimpinan)</div>
		</div>
		<div class="divtablecell sig4">
			<div>Dibukukan</div>
			<br/><br/><br/>
			<div>(Accounting)</div>
		</div>
	</div>
</div>
