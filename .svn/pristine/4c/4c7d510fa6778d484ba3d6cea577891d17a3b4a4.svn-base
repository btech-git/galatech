<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 20% }
        .width1-2 { width: 65% }
        .width1-3 { width: 15% }
        
        .width2-1 { width: 15% }
        .width2-2 { width: 15% }
        .width2-3 { width: 20% }
        .width2-4 { width: 10% }
        .width2-5 { width: 15% }
        .width2-6 { width: 10% }
        .width2-7 { width: 15% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">PT. GALATECH</div>
    <div style="font-size: larger">Laporan Pembelian Barang berdasarkan Produk</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1">Kategori</th>
        <th class="width1-2">Nama Produk</th>
        <th class="width1-3">Ukuran</th>
    </tr>
    <tr id="header2">
        <td colspan="3">
            <table>
                <tr>
                    <th class="width2-1">Pembelian #</th>
                    <th class="width2-2">Tanggal</th>
                    <th class="width2-3">Supplier</th>
                    <th class="width2-4">Jumlah</th>
                    <th class="width2-5">Harga</th>
                    <th class="width2-6">Disc</th>
                    <th class="width2-7">Total</th>
                </tr>
            </table>
        </td>
    </tr>
    <?php $totalPurchase = 0; ?>
    <?php foreach ($purchaseItemsReport->dataProvider->data as $i => $header): ?>
        <tr class="items1">
            <td class="width1-1" style="text-align:center"><?php echo CHtml::encode(CHtml::value($header, 'category.name')); ?></td>
            <td class="width1-2" style="text-align:center"><?php echo CHtml::encode(CHtml::value($header, 'name')); ?></td>
            <td class="width1-3" style="text-align:center"><?php echo CHtml::encode(CHtml::value($header, 'size')); ?></td>
        </tr>
        <tr class="items2">
            <td colspan="3">
                <table>
                    <?php $purchaseDetailData = $header->getPurchaseItemsReport($startDate, $endDate); ?>
                    <?php $totalQuantity = 0; ?>
                    <?php $totalAmount = 0; ?>
                    <?php foreach ($purchaseDetailData as $purchaseDetailRow): ?>
                        <tr>
                            <td class="width2-1" style="text-align: left"><?php echo CHtml::encode($purchaseDetailRow['number']); ?></td>
                            <td class="width2-2" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($purchaseDetailRow['date']))); ?>
                            </td>
                            <td class="width2-3" style="text-align: left"><?php echo CHtml::encode($purchaseDetailRow['company']); ?></td>														
                            <td class="width2-4" style="text-align: center">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchaseDetailRow['quantity'])); ?>
                            </td>
                            <td class="width2-5" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchaseDetailRow['unit_price'])); ?>
                            </td>
                            <td class="width2-6" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchaseDetailRow['discount'])); ?>
                            </td>
                            <td class="width2-7" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchaseDetailRow['total'])); ?>
                            </td>
                        </tr>
                        <?php $totalQuantity += $purchaseDetailRow['quantity']; ?>
                        <?php $totalAmount += $purchaseDetailRow['total']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="border-top: 1px solid; font-weight: bold; text-align: right">TOTAL</td>
                        <td class="width2-4" style="border-top: 1px solid; font-weight: bold; text-align: center; font-size: small">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ceil($totalQuantity))); ?>
                        </td>
                        <td colspan="2" style="border-top: 1px solid"></td>
                        <td class="width2-7" style="border-top: 1px solid; font-weight: bold; text-align: right; font-size: small">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ceil($totalAmount))); ?>
                        </td>
                    </tr>
                    <?php $totalPurchase += $totalAmount; ?>
                </table>
            </td>
        </tr>
    <?php endforeach; ?>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: right">Total Pembelian</td>
            <td style="font-weight: bold; text-align: right;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ceil($totalPurchase))); ?></td>
        </tr>
</table>