<?php
$this->breadcrumbs=array(
	'Sales Cheque'=>array('/transaction/salesCheque/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$salesCheque,
	'attributes'=>array(
		array(
			'label' => 'Penerimaan Faktur #',
			'value' => $salesCheque->number,
		),
		array(
			'label'=>'Tanggal Terima',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $salesCheque->receive_date),
		),
		array(
			'label'=>'Tanggal Akhir',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $salesCheque->due_date),
		),
	),
)); ?>

<br/>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'salesCheque-detail-grid',
	'dataProvider'=>new CArrayDataProvider($salesCheque->salesChequeDetails),
	'columns'=>array(
		'receiptHeader.number: Nomor Faktur',
		array(
			'header'=>'Total Penerimaan',
			'value'=>'number_format($data->receiptHeader->totalInvoice, 2)',
			'htmlOptions'=>array(
				'style'=>'text-align: right',
				),
			),
		'cheque_number: Nomor Cek',
		array(
			'header'=>'Jumlah',
			'value'=>'number_format($data->amount, 2)',
			'htmlOptions'=>array(
				'style'=>'text-align: right',
			),
		),
		'memo: Memo',
		'account.name: Bank',
	),
)); ?>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$salesCheque->id)); ?>
    <?php echo CHtml::link('Print Sales Cheque', array('memo', 'id'=>$salesCheque->id), array('target'=>'_blank')); ?>
</div>