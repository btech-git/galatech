<?php
$this->breadcrumbs=array(
	'Purchase Invoice'=>array('/transaction/purchaseInvoice/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$purchaseInvoice,
	'attributes'=>array(
		array(
			'label' => 'Penerimaan Faktur #',
			'value' => $purchaseInvoice->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseInvoice->date),
		),
		array(
			'label' => 'Pembelian #',
			'value' => $purchaseInvoice->purchaseHeader->number,
		),
		array(
			'label' => 'Supplier',
			'value' => $purchaseInvoice->purchaseHeader->supplier->company,
		),
		array(
			'label' => 'Faktur #',
			'value' => $purchaseInvoice->reference,
		),
		array(
			'label' => 'Jumlah (Rp)',
			'value' => number_format($purchaseInvoice->totalPurchase, 2),
		),
		array(
			'label' => 'Catatan',
			'value' => $purchaseInvoice->note,
		),
	),
)); ?>

<br/>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$purchaseInvoice->id)); ?>
    <?php echo CHtml::link('Print Purchase Invoice', array('memo', 'id'=>$purchaseInvoice->id), array('target'=>'_blank')); ?>
</div>