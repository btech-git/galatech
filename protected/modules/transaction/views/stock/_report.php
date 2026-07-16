<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 10% }
        .width1-2 { width: 20% }
        .width1-3 { width: 10% }
        .width1-4 { width: 10% }
        .width1-5 { width: 10% }
        .width1-6 { width: 10% }
        .width1-7 { width: 10% }
        .width1-8 { width: 10% }
        .width1-9 { width: 10% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">GALATECH</div>
    <div style="font-size: larger">Mutasi Stok Barang Global</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1">Kategori</th>
        <th class="width1-2">Nama Produk</th>
        <th class="width1-3">Ukuran</th>
        <th class="width1-4">Stok Awal</th>
        <th class="width1-5">Stok Masuk</th>
        <th class="width1-6">Stok Keluar</th>
        <th class="width1-7">Stok Akhir</th>
<!--        <th class="width1-8">HPP</th>
        <th class="width1-9">Nilai Stok</th>-->
    </tr>
    <tr id="header2">
        <td colspan="7"></td>
    </tr>
    <?php foreach ($dataProvider->data as $header): ?>
        <?php $beginningStock = $header->getStockBeginning($startDate); ?>
        <?php $stockIn = $header->getStockIn($startDate, $endDate); ?>
        <?php $stockOut = $header->getStockOut($startDate, $endDate); ?>
        <?php $endingStock = $beginningStock + $stockIn - $stockOut; ?>
        <?php $costOfGoodsSold = $header->costOfGoodsSold; ?>
        <?php $totalStockValue = $endingStock * $costOfGoodsSold; ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'category.name')); ?></td>
            <td class="width1-2"><?php echo CHtml::encode(CHtml::value($header, 'name')); ?></td>
            <td class="width1-3" style="text-align: center"><?php echo CHtml::encode(CHtml::value($header, 'size')); ?></td>
            <td class="width1-4" style="text-align: center">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $beginningStock)); ?>
            </td>
            <td class="width1-5" style="text-align: center">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stockIn)); ?>
            </td>
            <td class="width1-6" style="text-align: center">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $stockOut)); ?>
            </td>
            <td class="width1-7" style="text-align: center">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $endingStock)); ?>
            </td>
<!--            <td class="width1-8" style="text-align: right">
                <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $costOfGoodsSold)); ?>
            </td>
            <td class="width1-9" style="text-align: right">
                <?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $totalStockValue)); ?>
            </td>-->
        </tr>
    <?php endforeach; ?>
</table>