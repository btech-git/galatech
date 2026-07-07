<?php
$this->breadcrumbs = array(
    'Invoice' => array('/transaction/invoice/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $invoice,
    'attributes' => array(
        array(
            'label' => 'Invoice #',
            'value' => $invoice->number,
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $invoice->date),
        ),
        array(
            'label' => 'Pengiriman #',
            'value' => $invoice->deliveryHeader->number,
        ),
        array(
            'label' => 'Customer',
            'value' => $invoice->deliveryHeader->customer->company,
        ),
        array(
            'label' => 'Board',
            'value' => $invoice->board->name,
        ),
        array(
            'label' => 'Catatan',
            'value' => $invoice->note,
        ),
    ),
));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'invoice-detail-grid',
    'dataProvider' => new CArrayDataProvider($invoice->deliveryHeader->deliveryDetails),
    'columns' => array(
        'product.name: Nama Barang',
        'product.size: Ukuran',
        'quantity: Jumlah',
        'product.unit.name: Satuan',
        array(
            'header' => 'Harga Satuan',
            'value' => 'number_format($data->unit_price, 0)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
//        array(
//            'header' => 'DPP',
//            'value' => 'number_format($data->price_before_tax, 0)',
//            'htmlOptions' => array(
//                'style' => 'text-align: right',
//            ),
//        ),
        array(
            'header' => 'Diskon (%)',
            'value' => 'number_format($data->discount, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: center',
            ),
        ),
        array(
            'header' => 'Total',
            'value' => 'number_format($data->getTotal($data->deliveryHeader->tax_type, $data->deliveryHeader->tax), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
    ),
)); ?>
<table>
    <?php $delivery = $invoice->deliveryHeader; ?>
    <tr style="background-color: aquamarine">
        <td style="text-align: right;width: 40%;font-weight: bold">Total Qty</td>
        <td style="text-align: right;width: 10%;font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $delivery->subTotalQuantity)); ?>
        </td>
        <td style="text-align: right;width: 40%;font-weight: bold">Sub Total:</td>
        <td style="text-align: right;width: 10%;font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->subTotal)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="text-align: right" colspan="3">Diskon <?php echo CHtml::encode(CHtml::value($delivery, 'discount')); ?>%</td>
        <td style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->calculatedDiscount)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="text-align: right" colspan="3">Uang Muka</td>
        <td style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->downpayment_amount)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="text-align: right" colspan="3">
            PPn <?php //echo CHtml::encode(CHtml::value($delivery, 'taxTypeLiteral')); ?>
            <?php echo CHtml::encode(CHtml::value($delivery, 'tax')); ?>%
        </td>
        <td style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->calculatedTax)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="text-align: right" colspan="3">Ongkos Kirim</td>
        <td style="text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->shipping_fee)); ?>
        </td>
    </tr>
    <tr style="background-color: aquamarine">
        <td style="text-align: right;font-weight: bold" colspan="3">Grand Total</td>
        <td style="text-align: right; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $delivery->grandTotal)); ?>
        </td>
    </tr>
</table>

<div id="link">
    <?php /*echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id' => $invoice->id));*/ ?>
    <?php echo CHtml::link('Print Invoice', array('memo', 'id' => $invoice->id), array('target' => '_blank')); ?>
</div>
<br />

<?php if (!TaxConnectionChecking::isCurrentConnectionSecondary()): ?>
    <div><?php //echo CHtml::link('Print Faktur Pajak', array('taxForm/memo', 'id'=>$invoice->taxForms[0]->id, 'modelType' => 2), array('target'=>'_blank'));  ?></div>
<?php endif; ?>