<?php
$this->breadcrumbs=array(
	'Purchase Return'=>array('/transaction/purchaseReturn/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$purchaseReturn,
	'attributes'=>array(
		array(
			'label'=>'Retur #',
			'value'=>$purchaseReturn->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseReturn->date),
		),
		array(
			'label'=>'Supplier',
			'value'=>$purchaseReturn->purchaseInvoice->purchaseHeader->supplier->company,
		),
		array(
			'label'=>'Faktur Pembelian #',
			'value'=>($purchaseReturn->purchaseInvoice === null) ? '' : $purchaseReturn->purchaseInvoice->number,
		),
		array(
			'label'=>'Gudang',
			'value'=>($purchaseReturn->warehouse === null) ? '' : $purchaseReturn->warehouse->name,
		),
		array(
			'label'=>'Catatan',
			'value'=>$purchaseReturn->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-detail-grid',
	'dataProvider'=>new CArrayDataProvider($purchaseReturn->purchaseReturnDetails),
	'columns'=>array(
		'product.name: Nama Barang',
		'product.size: Ukuran',
//                array(
//					'header'=>'Jumlah Beli',
//					'value'=>'number_format($data->quantityPurchased, 0)',
//					'htmlOptions'=>array(
//						'style'=>'text-align: right',
//					),
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

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$purchaseReturn->id)); ?>
	<?php echo CHtml::link('Print Nota Retur Pembelian', array('memo', 'id'=>$purchaseReturn->id), array('target'=>'_blank')); ?>
</div>