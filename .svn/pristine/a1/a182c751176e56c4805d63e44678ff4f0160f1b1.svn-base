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

	.sig1 { width: 15% }
	.sig2 { width: 15% }
	.sig3 { width: 15% }
	.sig4 { width: 15% }
	.sig5 { width: 15% }
	.sig6 { width: 25% }
');
?>

<div id="memoheader">
	<div style="font-size: larger"><?php echo $depositHeaderText; ?></div>
	<div style="font-size: larger"> Nota Penerimaan Kas/Bank</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Nota #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($deposit, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($deposit, 'date')))); ?></div>
				</div>
			</div>
		</div>
		<div class="divtablecell hcolumn2">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn2header" style="font-weight: bold">Account</div>
					<div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($deposit, 'account.name')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn2header" style="font-weight: bold">Catatan</div>
					<div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($deposit, 'note')); ?></div>
				</div>
			</div>
		</div>
	</div>
</div>

<br />

<table class="memo">
	<tr id="theader">
		<th>Keterangan</th>
		<th>Jumlah</th>
		<th>Memo</th>
	</tr>
        <?php foreach ($deposit->depositDetails as $i=>$detail): ?>
			<tr class="titems">
				<td><?php echo CHtml::encode(CHtml::value($detail, 'account.name')); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'amount'))); ?></td>
				<td style="text-align: right"><?php echo CHtml::encode(CHtml::value($detail, 'memo')); ?></td>
			</tr>
        <?php endforeach; ?>
        <?php for ($j = 5, $i = $i % $j + 1; $j > $i; $j--): ?>
			<tr class="titems">
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
        <?php endfor; ?>
        <tr>
			<td style="border-top: 2px solid; font-weight: bold; text-align: right">Total</td>
			<td style="border-top: 2px solid; font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($deposit, 'total')))); ?></td>
			<td style="border-top: 2px solid"></td>
        </tr>
</table>

<div style="text-transform: capitalize">
	Terbilang:
	<?php echo CHtml::encode(NumberWord::numberName(floor(CHtml::value($deposit, 'total')))); ?>
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