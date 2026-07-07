<?php
$this->breadcrumbs=array(
	'Expense'=>array('/transaction/expense/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$expense,
	'attributes'=>array(
		array(
			'label'=>'Pengeluaran #',
			'value'=>$expense->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $expense->date),
		),
		array(
			'label'=>'Akun',
			'value'=>$expense->account->name,
		),
		array(
			'label'=>'Catatan',
			'value'=>$expense->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'expense-detail-grid',
	'dataProvider'=>new CArrayDataProvider($expense->expenseDetails),
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
    <?php echo CHtml::link('Edit', array('create', 'id'=>$expense->id)); ?>
    <?php echo CHtml::link('Print Pengeluaran Kas' , array('memo', 'id'=>$expense->id), array('target'=>'_blank')); ?>
</div>