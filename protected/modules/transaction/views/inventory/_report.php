<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 35% }
        .width1-3 { width: 10% }
        .width1-4 { width: 10% }
        .width1-5 { width: 15% }
        .width1-6 { width: 15% }
		
        .width2-1 { width: 10% }
        .width2-2 { width: 10% }
        .width2-3 { width: 10% }
        .width2-4 { width: 20% }
        .width2-5 { width: 10% }
        .width2-6 { width: 10% }
        .width2-7 { width: 10% }
        .width2-8 { width: 10% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">PT. GALATECH JAYA ABADI</div>
    <div style="font-size: larger">Laporan Stok Inventory Gudang</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1">Kategori</th>
        <th class="width1-2">Nama Produk</th>
        <th class="width1-3">Ukuran</th>
        <th class="width1-4">Stok</th>
<!--        <th class="width1-5">HPP</th>
        <th class="width1-6">Nilai Stok</th>-->
    </tr>
    <tr id="header2">
        <td colspan="4">
            <table>
                <tr>
                    <th class="width2-1">Transaksi #</th>
                    <th class="width2-2">Tanggal</th>
                    <th class="width2-3">Jenis</th>
                    <th class="width2-4">Pelaksana</th>
                    <th class="width2-5">Gudang</th>
                    <th class="width2-6">Jml Masuk</th>
                    <th class="width2-7">Jml Keluar</th>
                </tr>
            </table>
        </td>
    </tr>
    <?php foreach ($dataProvider->data as $header): ?>
        <?php $stock = $header->getStockBeginning($startDate); ?>
        <?php $stockQuantity = $header->getCurrentStock(); ?>
        <?php $costOfGoodsSold = $header->costOfGoodsSold; ?>
        <?php $totalStockValue = $stockQuantity * $costOfGoodsSold; ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'category.name')); ?></td>
            <td class="width1-2"><?php echo CHtml::encode(CHtml::value($header, 'name')); ?></td>
            <td class="width1-3"><?php echo CHtml::encode(CHtml::value($header, 'size')); ?></td>
<!--            <td class="width1-4" style="text-align: center">
                <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stock)); ?>
            </td>-->
            <td class="width1-4" style="text-align: center">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stockQuantity)); ?>
            </td>
<!--            <td class="width1-5" style="text-align: right">
                <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $costOfGoodsSold)); ?>
            </td>
            <td class="width1-6" style="text-align: right">
                <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $totalStockValue)); ?>
            </td>-->
        </tr>
        <tr class="items2">
            <td colspan="4">
                <table>
                    <?php $stockData = $header->getInventoryStockReport($startDate, $endDate); ?>
                    <?php foreach ($stockData as $stockRow): ?>
                        <?php $inventory = Inventory::model()->findByPk($stockRow['id']); ?>
                        <?php $transactionNumber = $stockRow['transaction_number']; ?>
                        <?php $stockIn = $stockRow['quantity_in']; ?>
                        <?php $stockOut = $stockRow['quantity_out']; ?>
                        <?php $stock += $stockIn - $stockOut; ?>
                        <tr>
                            <td class="width2-1"><?php echo $transactionNumber; ?></td>
                            <td class="width2-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($stockRow['date']))); ?></td>
                            <td class="width2-3"><?php echo CHtml::encode($inventory->getTransactionType()); ?></td>
                            <td class="width2-4"><?php echo CHtml::encode($stockRow['transaction_subject']); ?></td>
                            <td class="width2-5"><?php echo CHtml::encode($stockRow['warehouse_name']); ?></td>
                            <td class="width2-6" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stockIn)); ?>
                            </td>
                            <td class="width2-7" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stockOut)); ?>
                            </td>
<!--                            <td class="width2-8" style="text-align: right">
                                <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stock)); ?>
                            </td>	-->
                        </tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
    <?php endforeach; ?>
</table>