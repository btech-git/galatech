<?php
Yii::app()->clientScript->registerCss('_report', '
        .width1-1 { width: 15% }
        .width1-2 { width: 15% }
        .width1-3 { width: 20% }
        .width1-4 { width: 20% }
        .width1-5 { width: 30% }
        
        .width2-1 { width: 40% }
        .width2-2 { width: 5% }
        .width2-3 { width: 10% }
        .width2-4 { width: 5% }
        .width2-5 { width: 15% }
        .width2-6 { width: 10% }
        .width2-7 { width: 15% }
');
?>

<div style="font-weight: bold; text-align: center">
        <div style="font-size: larger">PT. GALATECH JAYA ABADI</div>
        <div style="font-size: larger">Laporan Pengiriman Barang</div>
        <div><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($startDate))) . ' &nbsp;&ndash;&nbsp; ' . CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table class="report">
        <tr id="header1">
                <th class="width1-1">Pengiriman #</th>
                <th class="width1-2">Tanggal</th>
                <th class="width1-3">Customer</th>
                <th class="width1-4">Gudang</th>
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
                                        <th class="width2-6">Diskon (%)</th>
                                        <th class="width2-7">Total</th>
                                </tr>
                        </table>
                </td>
        </tr>
        <?php foreach ($dataProvider->data as $header): ?>
                <tr class="items1">
                        <td class="width1-1"><?php echo CHtml::encode(CHtml::value($header, 'number')); ?></td>
                        <td class="width1-2"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($header->date))); ?></td>
                        <td class="width1-3" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, ($header->is_non_tax) ? 'customer.name' : 'customer.company')); ?></td>
                        <td class="width1-4" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'warehouse.name')); ?></td>
                        <td class="width1-5" style="text-align: right"><?php echo CHtml::encode(CHtml::value($header, 'note')); ?></td>
                </tr>
                <tr class="items2">
                        <td colspan="5">
                                <table>
                                        <?php foreach ($header->deliveryDetails as $detail): ?>
                                                <tr>
                                                        <td class="width2-1"><?php echo CHtml::encode(CHtml::value($detail, 'product_name')); ?></td>
                                                        <td class="width2-2" style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?></td>
                                                        <td class="width2-3" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
                                                        <td class="width2-4"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
														<td class="width2-5" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unit_price'))); ?></td>
                                                        <td class="width2-6" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'discount'))); ?></td>
                                                        <td class="width2-7" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'total'))); ?></td>
                                                </tr>
                                        <?php endforeach; ?>
										<tr>
                                                <td class="width2-1" style="border-top: 1px solid"></td>
                                                <td class="width2-2" style="border-top: 1px solid"></td>
                                                <td class="width2-3" style="border-top: 1px solid"></td>
                                                <td class="width2-4" style="border-top: 1px solid"></td>
                                                <td class="width2-5" style="border-top: 1px solid; font-weight: bold">Sub Total</td>
                                                <td class="width2-6" style="border-top: 1px solid"></td>
                                                <td class="width2-7" style="border-top: 1px solid; font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->subTotal)); ?></td>
                                        </tr>
                                        <tr>
                                                <td class="width2-1"></td>
                                                <td class="width2-2"></td>
                                                <td class="width2-3"></td>
                                                <td class="width2-4"></td>
                                                <td class="width2-5" style="font-weight: bold">Discount (<?php echo CHtml::encode(CHtml::value($header, 'discount')); ?> %)</td>
                                                <td class="width2-6"></td>
                                                <td class="width2-7" style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->calculatedDiscount)); ?></td>
                                        </tr>
                                        <tr>
                                                <td class="width2-1"></td>
                                                <td class="width2-2"></td>
                                                <td class="width2-3"></td>
                                                <td class="width2-4"></td>
                                                <td class="width2-5" style="font-weight: bold">Uang Muka</td>
                                                <td class="width2-6"></td>
                                                <td class="width2-7" style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ($header->salesDownpayment === null) ? 0.00 : $header->salesDownpayment->amount)); ?></td>
                                        </tr>
                                        <tr>
                                                <td class="width2-1"></td>
                                                <td class="width2-2"></td>
                                                <td class="width2-3"></td>
                                                <td class="width2-4"></td>
                                                <td class="width2-5" style="font-weight: bold">PPN (<?php echo CHtml::encode(CHtml::value($header, 'tax')); ?> %)</td>
                                                <td class="width2-6"></td>
                                                <td class="width2-7" style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->calculatedTax)); ?></td>
                                        </tr>
                                        <tr>
                                                <td class="width2-1"></td>
                                                <td class="width2-2"></td>
                                                <td class="width2-3"></td>
                                                <td class="width2-4"></td>
                                                <td class="width2-5" style="font-weight: bold">Ongkos Kirim</td>
                                                <td class="width2-6"></td>
                                                <td class="width2-7" style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $header->shipping_fee)); ?></td>
                                        </tr>
                                        <tr>
                                                <td class="width2-1"></td>
                                                <td class="width2-2"></td>
                                                <td class="width2-3"></td>
                                                <td class="width2-4"></td>
                                                <td class="width2-5" style="font-weight: bold">GRAND TOTAL</td>
                                                <td class="width2-6"></td>
                                                <td class="width2-7" style="font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ceil($header->grandTotal))); ?></td>
                                        </tr>
                                </table>
                        </td>
                </tr>
        <?php endforeach; ?>
		<tr>
                <td class="width1-1" style="border-top: 1px solid"></td>
                <td class="width1-2" style="border-top: 1px solid"></td>
                <td class="width1-3" style="border-top: 1px solid"></td>
                <td class="width2-4" style="border-top: 1px solid; font-weight: bold">TOTAL PENGIRIMAN</td>
                <td class="width2-5" style="border-top: 1px solid; font-weight: bold; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', ceil($this->reportGrandTotal($dataProvider)))); ?></td>
        </tr>
</table>