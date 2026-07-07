<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 15% }
        .width1-4 { width: 20% }
        .width1-5 { width: 35% }
        
        .width2-1 { width: 40% }
        .width2-2 { width: 10% }
        .width2-3 { width: 10% }
        .width2-4 { width: 5% }
        .width2-5 { width: 12% }
        .width2-6 { width: 8% }
        .width2-7 { width: 15% }
');
?>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">PT. GALATECH</div>
    <div style="font-size: larger">Laporan Penjualan</div>
    <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
    <tr id="header1">
        <th class="width1-1">Invoice #</th>
        <th class="width1-2">Tanggal</th>
        <th class="width1-3">Pengiriman #</th>
        <th class="width1-4">Customer</th>
        <th class="width1-5">Catatan</th>
    </tr>
    <tr id="header2">
        <td colspan="5">
            <table>
                <tr>
                    <th class="width2-1">Nama Barang</th>
                    <th class="width2-2">Ukuran</th>
                    <th class="width2-3">Jumlah</th>
                    <th class="width2-4">Satuan</th>
                    <th class="width2-5">Harga Satuan</th>
                    <th class="width2-6">Disc %</th>
                    <th class="width2-7">Total</th>
                </tr>
            </table>
        </td>
    </tr>
    <?php $totalSalesAmount = '0.00'; ?>
    <?php foreach ($dataProvider->data as $header): ?>
        <tr class="items1">
            <td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'codeNumber')); ?></td>
            <td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
            <td class="width1-3" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'deliveryHeader.number')); ?></td>
            <td class="width1-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, ($header->is_non_tax) ? 'deliveryHeader.customer.name' : 'deliveryHeader.customer.company')); ?></td>
            <td class="width1-5" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
        </tr>
        <tr class="items2">
            <td colspan="5">
                <table>
                    <?php foreach ($header->deliveryHeader->deliveryDetails as $detail): ?>
                        <tr>
                            <td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?></td>
                            <td class="width2-2" style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?></td>
                            <td class="width2-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
                            <td class="width2-4"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
                            <td class="width2-5" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unit_price'))); ?>
                            </td>
                            <td class="width2-6" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'discount'))); ?>
                            </td>
                            <td class="width2-7" style="text-align: right">
                                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'total'))); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5" style="border-top: 1px solid; font-weight: bold; text-align: right">Sub Total</td>
                        <td colspan="2" style="border-top: 1px solid; font-weight: bold; text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->deliveryHeader->subTotalPayment)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-weight: bold; text-align: right">Discount</td>
                        <td colspan="2" style="font-weight: bold; text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->deliveryHeader->calculatedDiscount)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-weight: bold; text-align: right">Uang Muka</td>
                        <td colspan="2" style="font-weight: bold; text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ($header->deliveryHeader->salesDownpayment === null) ? 0.00 : $header->deliveryHeader->downpayment_amount)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-weight: bold; text-align: right">PPN</td>
                        <td colspan="2" style="font-weight: bold; text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->deliveryHeader->calculatedTax)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-weight: bold; text-align: right">Ongkos Kirim</td>
                        <td colspan="2" style="font-weight: bold; text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->deliveryHeader->shipping_fee)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="font-weight: bold; text-align: right">GRAND TOTAL</td>
                        <td colspan="2" style="font-weight: bold; text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor($header->deliveryHeader->grandTotalPayment))); ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $totalSalesAmount += $header->deliveryHeader->grandTotalPayment; ?>
    <?php endforeach; ?>
    <tr>
        <td colspan="4" style="border-top: 1px solid; font-weight: bold; text-align: right">TOTAL PENJUALAN</td>
        <td style="border-top: 1px solid; font-weight: bold; text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $totalSalesAmount)); ?></td>
    </tr>
</table>