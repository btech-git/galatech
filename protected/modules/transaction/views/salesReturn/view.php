<?php
$this->breadcrumbs=array(
	'Sales Return'=>array('/transaction/salesReturn/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$salesReturn,
	'attributes'=>array(
		array(
			'label'=>'Retur #',
			'value'=>$salesReturn->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $salesReturn->date),
		),
		array(
			'label'=>'Invoice #',
			'value'=>$salesReturn->invoiceHeader->codeNumber,
		),
		array(
			'label'=>'Customer',
			'value'=>$salesReturn->invoiceHeader->deliveryHeader->customer->company,
		),
		array(
			'label'=>'Gudang',
			'value'=>$salesReturn->warehouse->name,
		),
		array(
			'label'=>'Catatan',
			'value'=>$salesReturn->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-detail-grid',
	'dataProvider'=>new CArrayDataProvider($salesReturn->salesReturnDetails),
	'columns'=>array(
		'product.name: Nama Barang',
		'product.size: Ukuran',
//                array(
//                        'header'=>'Jumlah Terjual',
//                        'value'=>'number_format($data->quantitySold, 0)',
//                        'htmlOptions'=>array(
//                                'style'=>'text-align: right',
//                        ),
//                ),
		array(
			'header'=>'Jumlah Retur',
			'value'=>'number_format($data->quantity, 0)',
			'htmlOptions'=>array(
					'style'=>'text-align: right',
			),
		),
		'product.unit.name: Satuan',
		array(
			'header'=>'Harga Satuan',
			'value'=>'number_format($data->unitPrice, 2)',
			'htmlOptions'=>array(
					'style'=>'text-align: right',
			),
		),
		array(
			'header'=>'Total',
			'value'=>'number_format($data->total, 2)',
			'htmlOptions'=>array(
					'style'=>'text-align: right',
			),
		),
	),
)); ?>
<table>
    <tr style="background-color: aquamarine">
        <td style="width: 40%">Total Qty</td>
        <td style="text-align: right;width: 10%">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $salesReturn->subTotalQuantity)); ?>
        </td>
        <td style="width: 40%;text-align: right;">Sub Total:</td>
        <td style="text-align: right; width: 10%;">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $salesReturn->subTotal)); ?>
        </td>
        <td></td>
    </tr>
</table>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$salesReturn->id)); ?>
	<?php echo CHtml::link('Print Nota Retur Penjualan', array('memo', 'id'=>$salesReturn->id), array('target'=>'_blank')); ?>
</div>
