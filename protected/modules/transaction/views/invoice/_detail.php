<table style="border: 1px solid">
    <tr style="background-color: skyblue">
        <th style="text-align: center">Nama Barang</th>
        <th style="text-align: center; text-align: center; width: 10%">Ukuran</th>
        <th style="text-align: center; text-align: center; width: 5%">Jumlah</th>
        <th style="text-align: center; text-align: center; width: 5%">Satuan</th>
        <th style="text-align: center; text-align: center; width: 15%">Harga Satuan</th>
        <th style="text-align: center; text-align: center; width: 10%">Diskon (%)</th>
        <th style="text-align: center; text-align: center; width: 15%">Total</th>
    </tr>
    <?php foreach ($delivery->deliveryDetails as $i => $detail): ?>
        <tr style="background-color: azure">
            <td>
                <?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?>
            </td>
            <td style="">
                <?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?>
            </td>
            <td style="">
                <?php echo CHtml::encode(CHtml::value($detail, 'quantity')); ?>
            </td>
            <td>
                <?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?>
            </td>
            <td style="text-align: right">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($detail, 'unit_price'))); ?>
            </td>
            <td style="text-align: right">
                <?php echo CHtml::encode(CHtml::value($detail, 'discount')); ?>
            </td>
            <td style="text-align: right">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $detail->getTotal($delivery->tax_type, $delivery->tax))); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr style="background-color: aquamarine">
        <td style="text-align: right; font-weight: bold" colspan="2">Total Qty</td>
        <td style="text-align: center; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $delivery->subTotalQuantity)); ?>
        </td>
        <td colspan="3" style="text-align: right; font-weight: bold">Sub Total:</td>
        <td style="text-align: right; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->subTotal)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="6" style="text-align: right">
            Discount <?php echo CHtml::encode(CHtml::value($delivery, 'discount')); ?>%
        </td>
        <td colspan="2" style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->calculatedDiscount)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="6" style="text-align: right">Uang Muka:</td>
        <td colspan="2" style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($delivery, 'downpayment_amount'))); ?></td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="6" style="text-align: right">
            PPn <?php echo CHtml::encode(CHtml::value($delivery, 'tax')); ?>%
        </td>
        <td colspan="2" style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->calculatedTax)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="6" style="text-align: right">Ongkos Kirim:</td>
        <td colspan="2" style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($delivery, 'shipping_fee'))); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td colspan="6" style="text-align: right; font-weight: bold">Grand Total:</td>
        <td colspan="2" style="font-weight: bold; text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->grandTotal)); ?>
        </td>
    </tr>
</table>