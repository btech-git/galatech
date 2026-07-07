<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 60% }
        .width1-2 { width: 15% }
        .width1-3 { width: 25% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">PT. GALATECH</div>
    <div style="font-size: larger">Laporan Penjualan per Kategori Produk</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <thead>
        <tr id="header1">
            <th class="width1-1">Kategori</th>
            <th class="width1-2">Total Quantity</th>
            <th class="width1-3">Total Price</th>
        </tr>
    </thead>
    <tbody>
        <?php $totalQuantity = 0; ?>
        <?php $totalPrice = '0.00'; ?>
        <?php foreach ($resultSet as $dataItem): ?>
            <tr class="items1">
                <td style="text-align: left"><?php echo CHtml::encode($dataItem['category_name']); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $dataItem['total_quantity'])); ?></td>
                <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $dataItem['total_price'])); ?></td>
            </tr>
            <?php $totalQuantity += $dataItem['total_quantity']; ?>
            <?php $totalPrice += $dataItem['total_price']; ?>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td style="text-align: right; border-top: 1px solid">Total</td>
            <td style="text-align: right; border-top: 1px solid"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $totalQuantity)); ?></td>
            <td style="text-align: right; border-top: 1px solid"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $totalPrice)); ?></td>
        </tr>
    </tfoot>
</table>