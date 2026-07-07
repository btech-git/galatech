<?php
$this->breadcrumbs=array(
	'Cheque'=>array('/transaction/cheque/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$cheque,
	'attributes'=>array(
		array(
			'label'=>'Giro #',
			'value'=>$cheque->number,
		),
		array(
			'label'=>'Tanggal Terima',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $cheque->receive_date),
		),
		array(
			'label'=>'Tanggal Jatuh Tempo',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $cheque->due_date),
		),
		array(
			'label'=>'Giro / Cek #',
			'value'=>$cheque->cheque_number,
		),
		 array(
			'label'=>'Catatan',
			'value'=>$cheque->note,
		),

		array(
			'label'=>'Bank',
			'value'=>$cheque->bank,
		),

		array(
			'label'=>'Jumlah (Rp)',
			'value'=>number_format($cheque->amount, 2),
		),

		 array(
			'label'=>'Tanda Terima Penjualan #',
			'value'=>$cheque->receiptHeader->number,
		),
		array(
			'label'=>'Tanggal Terima Penjualan',
			'value'=>$cheque->receiptHeader->date,
		),
		array(
			'label'=>'Customer',
			'value'=>$cheque->receiptHeader->customer->company,
		),
	),
)); ?>

<br />

<div>
	<?php echo CHtml::link('Print Cheque Order', array('memo', 'id'=>$cheque->id), array('target'=>'_blank')); ?>
</div>