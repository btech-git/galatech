<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 10% }
        .width1-2 { width: 10% }
        .width1-3 { width: 10% }
        .width1-4 { width: 10% }
        .width1-5 { width: 10% }
        .width1-6 { width: 10% }
        .width1-7 { width: 10% }
        .width1-8 { width: 30% }
        
        
');
?>

<div style="font-weight: bold; text-align: center">
        <div style="font-size: larger">PT. GALATECH</div>
        <div style="font-size: larger">Laporan Pajak</div>
        <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
        <tr id="header1">
                <th class="width1-1">Pajak Revisi #</th>
                <th class="width1-2">Tanggal</th>
                <th class="width1-3">Catatan</th>
        </tr>
        <tr id="header2">
                <td colspan="6">
                        <table>
                                <tr>
                                        <th class="width2-1">Nama Item</th>
                                        <th class="width2-2">Jumlah</th>
                                </tr>
                        </table>
                </td>
        </tr>
        <?php foreach ($dataProvider->data as $header): ?>
                <tr class="items1">
                        <td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
                        <td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
                        <td class="width1-3" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
                </tr>
                <tr class="items2">
                        <td colspan="6">
                                <table>
                                        <?php foreach ($header->receiveDetails as $detail): ?>
                                                <tr>
                                                        <td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'name')); ?></td>
                                                        <td class="width2-2"><?php echo CHtml::encode(CHtml::value($detail, 'price')); ?></td>
                                                </tr>
                                        <?php endforeach; ?>
                                </table>
                        </td>
                </tr>
        <?php endforeach; ?>
</table>