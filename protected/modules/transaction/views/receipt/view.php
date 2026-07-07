<?php
$this->breadcrumbs=array(
	'Receipt'=>array('/transaction/receipt/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$receipt,
	'attributes'=>array(
		array(
			'label'=>'Tanda Terima Penjualan #',
			'value'=>$receipt->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $receipt->date),
		),
		array(
			'label'=>'Customer',
			'value'=>$receipt->customer->company,
		),
		array(
			'label'=>'Catatan',
			'value'=>$receipt->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'receipt-detail-grid',
	'dataProvider'=>new CArrayDataProvider($receipt->receiptDetails),
	'columns'=>array(
		'invoiceHeader.codeNumber:Invoice #',
		array(
			'header' => 'Tanggal',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->invoiceHeader->date)',
		),
		'invoiceHeader.deliveryHeader.customer.company: Customer',
			array(
				'header'=>'Total(Rp)',
				'value'=>'number_format($data->invoiceHeader->deliveryHeader->grandTotal, 2)',
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
    <?php echo CHtml::link('Edit', array('create', 'id'=>$receipt->id)); ?>
	<?php echo CHtml::link('Print Receipt Order', array('memo', 'id'=>$receipt->id), array('target'=>'_blank')); ?>
</div>