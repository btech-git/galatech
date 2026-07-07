<?php
$this->breadcrumbs = array(
    'Purchase' => array('/transaction/purchase/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $purchase,
    'attributes' => array(
        array(
            'label' => 'Pembelian #',
            'value' => $purchase->number,
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $purchase->date),
        ),
        array(
            'label' => 'Supplier',
            'value' => $purchase->supplier->company,
        ),
        array(
            'label' => 'Catatan',
            'value' => $purchase->note,
        ),
    ),
));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchase-detail-grid',
    'dataProvider' => new CArrayDataProvider($purchase->purchaseDetails),
    'columns' => array(
        'product.name: Nama Barang',
        'product.size: Ukuran',
        array(
            'header' => 'Jumlah',
            'value' => 'number_format($data->quantity, 0)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        'product.unit.name: Satuan',
        array(
            'header' => 'Harga Satuan',
            'value' => 'number_format($data->unit_price, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'DPP',
            'value' => 'number_format($data->price_before_tax, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
        array(
            'header' => 'Diskon (%)',
            'value' => 'number_format($data->discount, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: center',
            ),
        ),
        array(
            'header' => 'Total',
            'value' => 'number_format($data->getTotal($data->purchaseHeader->tax_type, $data->purchaseHeader->tax), 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
    ),
)); ?>
<table style="background-color: aquamarine">
    <tr>
        <td style="text-align: right;width: 40%; font-weight: bold">Total Qty</td>
        <td style="text-align: right;width: 10%; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $purchase->subTotalQuantity)); ?>
        </td>
        <td style="text-align: right;width: 30%; font-weight: bold">Sub Total:</td>
        <td style="text-align: right;width: 20%; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->subTotal)); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;font-weight: bold" colspan="3">Diskon <?php echo CHtml::encode(CHtml::value($purchase, 'discount')); ?>%</td>
        <td style="text-align: right;font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->calculatedDiscount)); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;font-weight: bold" colspan="3">
            PPn <?php echo CHtml::encode(CHtml::value($purchase, 'taxTypeLiteral')); ?>
            <?php echo CHtml::encode(CHtml::value($purchase, 'tax')); ?>%
        </td>
        <td style="text-align: right;font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->calculatedTax)); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;font-weight: bold" colspan="3">Ongkos Kirim</td>
        <td style="text-align: right;font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->shipping_fee)); ?>
        </td>
    </tr>
    <tr>
        <td style="text-align: right;font-weight: bold" colspan="3">Grand Total</td>
        <td style="text-align: right; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $purchase->grandTotal)); ?>
        </td>
    </tr>
</table>

<div id="link">
<?php echo CHtml::link('Create', array('create')); ?>
<?php echo CHtml::link('Manage', array('admin')); ?>
<?php echo CHtml::link('Edit', array('create', 'id' => $purchase->id)); ?>
<?php echo CHtml::link('Print Purchase Order', array('memo', 'id' => $purchase->id), array('target' => '_blank')); ?>
<?php echo CHtml::link('Print Pengambilan Barang', array('memoPickup', 'id' => $purchase->id), array('target' => '_blank')); ?>
</div>