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
        
        .hcolumn1header { width: 55% }
        .hcolumn1value { width: 45% }
        .hcolumn2header { width: 55% }
        .hcolumn2value { width: 45% }
        
        .sig1 { width: 25% }
        .sig2 { width: 25% }
        .sig3 { width: 25% }
        .sig4 { width: 25% }
');
?>

<div id="memoheader">
		<div style="font-size: larger"><?php echo $purchaseChequeHeaderText; ?></div>
        <div style="font-size: larger">Pengeluaran Giro Pembelian</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Pengeluaran Giro #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($purchaseCheque, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Issue Date</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchaseCheque, 'issue_date')))); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Due Date</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchaseCheque, 'due_date')))); ?></div>
				</div>
			</div>
		</div>
		<div class="divtablecell hcolumn2">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn2header" style="font-weight: bold">Supplier</div>
					<div class="divtablecell info hcolumn2value"><?php echo $purchaseChequeSupplier; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<br />

<table class="memo">
        <tr id="theader">
			<th>Nomor Penerimaan</th>
			<th>Total Penerimaan</th>
			<th>Nomor Cek</th>
			<th>Jumlah</th>
			<th>Memo</th>
			<th>Bank</th>
        </tr>
        <?php foreach ($purchaseCheque->purchaseChequeDetails as $i=>$detail): ?>
			<tr class="titems">
				<td><?php echo CHtml::encode(CHtml::value($detail, 'purchaseReceiptHeader.number')); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseReceiptHeader.totalPurchase'))); ?></td>
				<td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'cheque_number')); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'amount'))); ?></td>
				<td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
				<td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'account.name')); ?></td>
			</tr>
        <?php endforeach; ?>
		<?php for ($j = 5, $i = $i % $j + 1; $j > $i; $j--): ?>
			<tr class="titems">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		<?php endfor; ?>
		 <tr>
			<td style="border-top: 2px solid; font-weight: bold">Total</td>
			<td style="border-top: 2px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($purchaseCheque, 'totalReceipt')))); ?></td>
			<td colspan="2" style="border-top: 2px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($purchaseCheque, 'total')))); ?></td>
			<td colspan="2" style="border-top: 2px solid"></td>
		 </tr>
</table>

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
			<div>Penerima</div>
			<br/><br/><br/>
			<div>(__________)</div>
		</div>
        </div>
</div>