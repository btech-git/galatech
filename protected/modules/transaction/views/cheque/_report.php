<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 10% }
        .width1-2 { width: 10% }
        .width1-3 { width: 10% }
        .width1-4 { width: 10% }
        .width1-5 { width: 10% }
        .width1-6 { width: 10% }
        .width1-7 { width: 10% }
        .width1-8 { width: 10% }
		.width1-9 { width: 10% }
		.width1-10 { width: 10% }
');
?>

<div style="font-weight: bold; text-align: center">
        <div style="font-size: larger">PT. GALATECH</div>
        <div style="font-size: larger">Laporan Penerimaan Giro</div>
        <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
        <tr id="header1">
                <th class="width1-1">Giro / Cek #</th>
                <th class="width1-2">Tanggal Terima</th>
                <th class="width1-3">Tanggal Jatuh Tempo</th>
                <th class="width1-4">Bank</th>
				<th class="width1-5">Nomor Giro</th>
				<th class="width1-6">Customer</th>
				<th class="width1-7">Jumlah (Rp)</th>
                <th class="width1-8">TT Penjualan #</th>
                <th class="width1-9">Tanggal TT</th>
                <th class="width1-10">Catatan</th>
                
               
        </tr>
        <tr id="header2">
                <td colspan="10">
                        
                </td>
        </tr>
        <?php foreach ($dataProvider->data as $header): ?>
                <tr class="items1">
                        <td class="width1-1" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'cheque_number')); ?></td>
                        <td class="width1-2" style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->receive_date))); ?></td>
                        <td class="width1-3" style="text-align: center"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->due_date))); ?></td>
						<td class="width1-4" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'bank')); ?></td>
						<td class="width1-5" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
						<td class="width1-6" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'receiptHeader.customer.company')); ?></td>
                        <td class="width1-7" style="text-align: center"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($header, 'amount'))); ?></td>
                        <td class="width1-8" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'receiptHeader.number')); ?></td>
						<td class="width1-9" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'receiptHeader.date')); ?></td>
						<td class="width1-10" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
						
                </tr>
                <tr class="items2">
                        <td colspan="10"></td>
                </tr>
        <?php endforeach; ?>
</table>