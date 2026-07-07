<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 25% }
        .width1-4 { width: 15% }
		.width1-4 { width: 15% }
		.width1-4 { width: 15% }
        
		.width2-1 { width: 30% }
        .width2-2 { width: 30% }
        .width2-3 { width: 40% }

');
?>

<div style="font-weight: bold; text-align: center">
	<div style="font-size: larger">PT. GALATECH JAYA ABADI</div>
	<div style="font-size: larger">Laporan Piutang Penjualan Barang</div>
	<div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
	<tr id="header1">
		<th class="width1-1">Invoice #</th>
		<th class="width1-2">Tanggal</th>
		<th class="width1-3">Pelanggan</th>
		<th class="width1-4">Total</th>
		<th class="width1-5">Pelunasan</th>
		<th class="width1-6">Sisa</th>
		
	</tr>
	<tr id="header2">
		<td colspan="6">
			<table>
				<th class="width2-1">Receipt #</th>
				<th class="width2-2">Tanggal</th>
				<th class="width2-3">Total</th>
				
			</table>	
		</td>
	</tr>
<?php foreach ($dataProvider->data as $header): ?>
	<tr class="items1">
		<td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
		<td class="width1-2" style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
		<td class="width1-3"><?php echo CHtml::encode(CHtml::value($header, 'customer.company')); ?></td>
		<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'totalInvoice'))); ?></td>
		<td class="width1-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'payment'))); ?></td>
		<td class="width1-6" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'remaining'))); ?></td>
		
	</tr>
	<tr class="items2">
		 <td colspan="6">
			<table>
				 <?php foreach ($header->receiptDetails as $detail): ?>
					<tr>
						<td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'invoiceHeader.number')); ?></td>
						<td class="width2-2" style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($detail->invoiceHeader->date))); ?></td>
						<td class="width1-4" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $detail->invoiceHeader->totalInvoice)); ?></td>
					</tr>
				<?php endforeach; ?>	
			</table>	
		</td>
	</tr>	
<?php endforeach; ?>
<tr>
	<td colspan="4" style="border-top: 1px solid; font-weight: bold; text-align: right">TOTAL PIUTANG</td>
	<td colspan="2" style="border-top: 1px solid; font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor($this->reportTotalReceivable($dataProvider)))); ?></td>
</tr>
</table>			
                                        
