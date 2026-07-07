<?php
$this->breadcrumbs=array(
	'Down Payment'=>array('/transaction/salesDownpayment/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$salesDownpayment,
	'attributes'=>array(
		array(
			'label'=>'Uang Muka #',
			'value'=>$salesDownpayment->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $salesDownpayment->date),
		),
		array(
			'label'=>'Customer',
			'value'=>$salesDownpayment->customer->company,
		),
		array(
			'label'=>'Board',
			'value'=>$salesDownpayment->board->name,
		),
		array(
			'label'=>'Akun',
			'value'=>$salesDownpayment->account->name,
		),
		array(
			'label'=>'Banyak',
			'value'=>number_format($salesDownpayment->quantity, 0),
		),
		array(
			'label'=>'Jumlah (Rp)',
			'value'=>number_format($salesDownpayment->amount, 2),
		),
		array(
			'label'=>'Pajak (%)',
			'value'=>number_format($salesDownpayment->tax, 0),
		),
		array(
			'label'=>'Catatan',
			'value'=>$salesDownpayment->note,
		),
	),
)); ?>
<br />
<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$salesDownpayment->id)); ?>
	<?php echo CHtml::link('Print Uang Muka Penjualan', array('memo', 'id'=>$salesDownpayment->id), array('target'=>'_blank')); ?>
</div>

<br/>

<div>
	<?php echo CHtml::link('Print Faktur Pajak Uang Muka', array('taxForm/memo', 'id'=>$salesDownpayment->taxForms[0]->id, 'modelType' => 1), array('target'=>'_blank')); ?>
</div>