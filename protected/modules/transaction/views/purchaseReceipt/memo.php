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
        .hcolumn2header { width: 35% }
        .hcolumn2value { width: 65% }
        
        .sig1 { width: 25% }
        .sig2 { width: 50% }
        .sig3 { width: 25% }
');
?>

<div id="memoheader">
        <div style="font-size: larger"><?php echo $purchaseReceiptHeaderText; ?></div>
        <div style="font-size: larger">TANDA TERIMA PEMBELIAN</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanda Terima #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($purchaseReceipt, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchaseReceipt, 'date')))); ?></div>
				</div>
			</div>
		</div>
		<div class="divtablecell hcolumn2">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn2header" style="font-weight: bold">Supplier</div>
					<div class="divtablecell info hcolumn2value"><?php echo $purchaseReceiptSupplier; ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<br />

<table class="memo">
        <tr id="theader">
			<th>Invoice #</th>
			<th>Faktur Supplier #</th>
			<th>Tanggal</th>
			<th>Jumlah</th>
        </tr>
        <?php foreach ($purchaseReceipt->purchaseReceiptDetails as $i=>$detail): ?>
			<tr class="titems">
				<td><?php echo CHtml::encode(CHtml::value($detail, 'purchaseInvoice.number')); ?></td>
				<td><?php echo CHtml::encode(CHtml::value($detail, 'purchaseInvoice.reference')); ?></td>
				<td style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('dd MMMM yyyy', strtotime(CHtml::value($detail, 'purchaseInvoice.date')))); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'purchaseInvoice.totalPurchase'))); ?></td>
			</tr>
        <?php endforeach; ?>
		<?php for ($j = 15, $i = $i % $j + 1; $j > $i; $j--): ?>
			<tr class="titems">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
        <?php endfor; ?>
		<tr>
			<td style="border-top: 2px solid;text-align: right; font-weight: bold" colspan="3">TOTAL</td>
			<td style="border-top: 2px solid;text-align: right; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', floor(CHtml::value($purchaseReceipt, 'totalPurchase')))); ?></td>
		</tr>
</table>

<div>
	Catatan: <?php echo CHtml::encode(CHtml::value($purchaseReceipt, 'note')); ?>
</div>
	
</br>

<div class="memosig">
	<div class="divtable">
		<div class="divtablecell sig1">
			<div>Penerima</div>
			<br/><br/><br/>
			<div>(Finance)</div>
		</div>
		<div class="divtablecell sig3">
			<div>yg menyerahkan</div>
			<br/><br/><br/>
			<div>(__________)</div>
		</div>
	</div>
</div>