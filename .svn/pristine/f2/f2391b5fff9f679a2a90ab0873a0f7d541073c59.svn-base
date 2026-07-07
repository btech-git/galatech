<?php
$this->breadcrumbs=array(
	'Deposit'=>array('/transaction/deposit/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$deposit,
	'attributes'=>array(
		array(
			'label'=>'Pemasukan #',
			'value'=>$deposit->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $deposit->date),
		),
		array(
			'label'=>'Akun',
			'value'=>$deposit->account->name,
		),
		array(
			'label'=>'Catatan',
			'value'=>$deposit->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'deposit-detail-grid',
	'dataProvider'=>new CArrayDataProvider($deposit->depositDetails),
	'columns'=>array(
		'account.code: Kode Akun',
		'account.name: Nama Akun',
		array(
				'header'=>'Jumlah',
				'value'=>'number_format($data->amount, 2)',
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
    <?php echo CHtml::link('Edit', array('create', 'id'=>$deposit->id)); ?>
	<?php echo CHtml::link('Print Pemasukan Kas' , array('memo', 'id'=>$deposit->id), array('target'=>'_blank')); ?>
</div>