<?php
Yii::app()->clientScript->registerScript('memo', '
        $("#header").addClass("hide");
        $("#mainmenu").addClass("hide");
        $(".breadcrumbs").addClass("hide");
        $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
        .hcolumn1 { width: 60% }
        .hcolumn2 { width: 50% }
        
        .hcolumn1header { width: 35% }
        .hcolumn1value { width: 65% }
        .hcolumn2header { width: 55% }
        .hcolumn2value { width: 45% }
        
        .sig1 { width: 25% }
        .sig2 { width: 25% }
        .sig3 { width: 25% }
        .sig4 { width: 25% }
');
?>

<div id="memoheader">
	<div style="font-size: larger"><?php echo $chequeHeaderText; ?></div>
	<div style="font-size: larger">Penerimaan Giro</div>
</div>

<br />

<div class="memonote">
	<div class="divtable">
		<div class="divtablecell hcolumn1">
			<div class="divtable">
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Nomor Giro #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($cheque, 'number')); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal Terima</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($cheque, 'receive_date')))); ?></div>
				</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal Jatuh Tempo</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($cheque, 'due_date')))); ?></div>
				</div>
				 <div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Giro / Cek #</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($cheque, 'cheque_number')); ?></div>
					</div>
				<div class="divtablerow">
					<div class="divtablecell info hcolumn1header" style="font-weight: bold">Catatan</div>
					<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($cheque, 'note')); ?></div>
				</div>
			</div>
			</div>
			<div class="divtablecell hcolumn2">
				<div class="divtable">
					<div class="divtablerow">
						<div class="divtablecell info hcolumn2header" style="font-weight: bold">Bank</div>
						<div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($cheque, 'bank')); ?></div>
					</div>
					<div class="divtablerow">
						<div class="divtablecell info hcolumn1header" style="font-weight: bold">Jumlah</div>
						<div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($cheque, 'amount'))); ?></div>
					</div>
					<div class="divtablerow">
						<div class="divtablecell info hcolumn2header" style="font-weight: bold">Tanda Terima Penjualan #</div>
						<div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($cheque, 'receiptHeader.number')); ?></div>
					</div>
					<div class="divtablerow">
						<div class="divtablecell info hcolumn2header" style="font-weight: bold">Tanggal Terima Penjualan</div>
						<div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($cheque, 'receiptHeader.date')); ?></div>
					</div>
					<div class="divtablerow">
						<div class="divtablecell info hcolumn2header" style="font-weight: bold">Customer</div>
						<div class="divtablecell info hcolumn2value"><?php echo $chequeCustomer; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>

<br />

<div class="memosig">
	<div class="divtable">
		<div class="divtablecell sig1">
			<div>Dibuat</div>
			<br/><br/><br/>
			<div>(Finance)</div>
		</div>
		 <div class="divtablecell sig2">
			<div>Diketahui</div>
			<br/><br/><br/>
			<div>(Pimpinan)</div>
		 </div>
	</div>
</div>