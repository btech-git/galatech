<?php
$this->breadcrumbs=array(
	'PurchaseReceipt'=>array('/transaction/purchaseReceipt/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$purchaseReceipt,
	'attributes'=>array(
		array(
			'label'=>'Tanda Terima #',
			'value'=>$purchaseReceipt->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseReceipt->date),
		),
		array(
			'label'=>'Supplier',
			'value'=>$purchaseReceipt->supplier->company,
		),
		array(
			'label'=>'Catatan',
			'value'=>$purchaseReceipt->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseReceipt-detail-grid',
	'dataProvider'=>new CArrayDataProvider($purchaseReceipt->purchaseReceiptDetails),
	'columns'=>array(
		'purchaseInvoice.number: Invoice #',
		array(
			'header' => 'Tanggal',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->purchaseInvoice->date)',
		),
		array(
			'header'=>'Total',
			'value'=>'number_format($data->purchaseInvoice->totalPurchase, 2)',
			'htmlOptions'=>array(
				'style'=>'text-align: right',
			),
		),
		'memo: Memo',
	),
)); ?>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$purchaseReceipt->id)); ?>
	<?php echo CHtml::link('Print Purchase Receipt Order', array('memo', 'id'=>$purchaseReceipt->id), array('target'=>'_blank')); ?>
</div>