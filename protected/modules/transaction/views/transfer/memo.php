<?php
Yii::app()->clientScript->registerScript('memo', '
        $("#header").addClass("hide");
        $("#mainmenu").addClass("hide");
        $(".breadcrumbs").addClass("hide");
        $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
        .hcolumn1 { width: 50% }
        .hcolumn2 { width: 50% }
        
        .hcolumn1header { width: 35% }
        .hcolumn1value { width: 65% }
        .hcolumn2header { width: 35% }
        .hcolumn2value { width: 65% }
        
        .sig1 { width: 25% }
        .sig2 { width: 25% }
        .sig3 { width: 25% }
        .sig4 { width: 25% }
');
?>

<div id="memoheader">
	<div style="font-size: 14px">PT. Galatech Jaya Abadi</div>
	<div style="font-size: 14px">SURAT JALAN TRANSFER</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Transfer #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($transfer, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($transfer, 'date')))); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Dibuat oleh</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($transfer, 'admin.name')); ?></div>
				</div>
				
			</div>
		</div>
		<div class="divtablecell hcolumn2">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Dari Gudang</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($transfer, 'warehouseIdFrom.code')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Ke Gudang</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($transfer, 'warehouseIdTo.code')); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<br />

<table class="memo">
	<tr id="theader">
		<th>Nama Barang</th>
		<th>Ukuran</th>
		<th>Jumlah</th>
		<th>Satuan</th>
	</tr>
	<?php $i = 0; ?>
	<?php foreach ($transfer->transferDetails as $i => $detail): ?>
		<tr class="titems">
			<td><?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?></td>
			<td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?></td>
			<td style="text-align: center"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($detail, 'quantity')))); ?></td>
			<td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
		</tr>
	<?php endforeach; ?>
	<?php for ($j = 12, $i = $i % $j + 1; $j > $i; $j--): ?>
		<tr class="titems">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	<?php endfor; ?>

</table>

<div>
	<span style="font-weight: bold">Catatan: </span> <?php echo CHtml::value($transfer, 'note'); ?>
</div>
<br />

<div class="memosig">
	<div class="divtable">
		<div class="divtablecell sig1">
			<div>Tanda Terima,</div>
		</div>
		<div class="divtablecell sig2">
			<div>Disiapkan oleh,</div>
		</div>
		<div class="divtablecell sig3">
			<div>Diperiksa oleh,</div>
		</div>
		<div class="divtablecell sig4">
			<div>Hormat kami,</div>
		</div>
	</div>
</div>
