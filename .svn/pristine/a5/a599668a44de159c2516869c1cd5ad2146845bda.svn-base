<?php
$this->breadcrumbs = array(
    'Indent' => array('/transaction/indent/create'),
    'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $indent,
    'attributes' => array(
        array(
            'label' => 'Indent #',
            'value' => $indent->number,
        ),
        array(
            'label' => 'Tanggal',
            'value' => Yii::app()->dateFormatter->format("d MMMM yyyy", $indent->date),
        ),
        array(
            'label' => 'Customer',
            'value' => $indent->customer->company,
        ),
        array(
            'label' => 'Catatan',
            'value' => $indent->note,
        ),
    ),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'indent-detail-grid',
    'dataProvider' => new CArrayDataProvider($indent->indentDetails),
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
            'header' => 'Total',
            'value' => 'number_format($data->total, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
    ),
));
?>

<table>
    <tr style="background-color: aquamarine">
        <td style="width: 35%">Total Qty</td>
        <td style="text-align: right;width: 10%">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $indent->subTotalQuantity)); ?>
        </td>

        <td style="text-align: right;width: 40%">Grand Total:</td>
        <td style="text-align: right;width: 15%">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $indent->grandTotal)); ?>
        </td>
    </tr>
</table>