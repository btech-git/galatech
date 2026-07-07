<?php
$this->breadcrumbs=array(
	'Journal Penyesuaian'=>array('/transaction/journalVoucher/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$journal,
	'attributes'=>array(
		array(
			'label'=>'Jurnal #',
			'value'=>$journal->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $journal->date),
		),
		array(
			'label'=>'Catatan',
			'value'=>$journal->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'journal-detail-grid',
	'dataProvider'=>new CArrayDataProvider($journal->journalVoucherDetails),
	'columns'=>array(
		'account.code: Kode Akun',
		'account.name: Nama Akun',
		array(
			'header'=>'Debit',
			'value'=>'number_format($data->debit, 2)',
			'htmlOptions'=>array(
				'style'=>'text-align: right',
			),
		),
		array(
			'header'=>'Credit',
			'value'=>'number_format($data->credit, 2)',
			'htmlOptions'=>array(
				'style'=>'text-align: right',
			),
		),
		'memo: Memo',
	),
)); ?>