<?php
$this->breadcrumbs = array(
	'Receive' => array('/transaction/receive/create'),
	'View',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data' => $receive,
	'attributes' => array(
		array(
			'label' => 'Penerimaan #',
			'value' => $receive->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $receive->date),
		),
		array(
			'label' => 'Pembelian #',
			'value' => $receive->purchaseHeader->number,
		),
		array(
			'label' => 'Faktur #',
			'value' => $receive->reference,
		),
		array(
			'label' => 'Supplier',
			'value' => $receive->purchaseHeader->supplier->company,
		),
		array(
			'label' => 'Gudang',
			'value' => $receive->warehouse->name,
		),
		array(
			'label' => 'Catatan',
			'value' => $receive->note,
		),
	),
));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'purchase-detail-grid',
	'dataProvider' => new CArrayDataProvider($receive->receiveDetails),
	'columns' => array(
		'product.name: Nama Barang',
		'product.size: Ukuran',
		array(
			'header' => 'Jumlah Pesanan',
			'value' => 'number_format($data->quantityOrdered, 0)',
			'htmlOptions' => array(
				'style' => 'text-align: right',
			),
		),
		array(
			'header' => 'Jumlah Diterima',
			'value' => 'number_format($data->quantity, 0)',
			'htmlOptions' => array(
				'style' => 'text-align: right',
			),
		),
		'product.unit.name: Satuan',
	),
));
?>
<table>
    <tr style="background-color: aquamarine">
        <td style="text-align: right;width: 70%;">Total Qty</td>
        <td style="text-align: right;width: 20%;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $receive->subTotalQuantity)); ?>
        </td>
        <td style="text-align: right;width: 10%;">&nbsp;</td>
    </tr>
</table>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$receive->id)); ?>
    <?php echo CHtml::link('Print Penerimaan Barang', array('memo', 'id' => $receive->id), array('target' => '_blank')); ?>
</div>