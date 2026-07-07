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
		<div style="font-size: larger"><?php echo $salesChequeHeaderText; ?></div>
        <div style="font-size: larger">Penerimaan Giro Penjualan</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Penerimaan Giro Pembelian #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($salesCheque, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal Terima</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salesCheque, 'receive_date')))); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Jatuh Tempo</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salesCheque, 'due_date')))); ?></div>
				</div>
			</div>
		</div>
		<div class="divtablecell hcolumn2">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn2header" style="font-weight: bold">Customer</div>
					<div class="divtablecell info hcolumn2value"><?php echo $salesChequeCustomer; ?></div>
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
        <?php foreach ($salesCheque->salesChequeDetails as $i=>$detail): ?>
			<tr class="titems">
				<td><?php echo CHtml::encode(CHtml::value($detail, 'receiptHeader.number')); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'receiptHeader.totalInvoice'))); ?></td>
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
			<td style="border-top: 2px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($salesCheque, 'totalReceipt')))); ?></td>
			<td colspan="2" style="border-top: 2px solid;text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($salesCheque, 'total')))); ?></td>
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