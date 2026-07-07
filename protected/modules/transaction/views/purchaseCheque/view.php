<?php
$this->breadcrumbs=array(
	'Purchase Cheque'=>array('/transaction/purchaseCheque/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$purchaseCheque,
	'attributes'=>array(
		array(
			'label' => 'Penerimaan Faktur #',
			'value' => $purchaseCheque->number,
		),
		array(
			'label'=>'Tanggal Mulai',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseCheque->issue_date),
		),
		array(
			'label'=>'Tanggal Akhir',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $purchaseCheque->due_date),
		),
//		array(
//			'label' => 'Nomor Giro #',
//			'value' => $purchaseCheque->cheque_number,
//		),
//		array(
//			'label' => 'Catatan',
//			'value' => $purchaseCheque->note,
//		),
//		array(
//			'label' => 'Bank',
//			'value' => $purchaseCheque->bank,
//		),
//		array(
//			'label' => 'Jumlah (Rp)',
//			'value' => number_format($purchaseCheque->amount, 2),
//		),
//		array(
//			'label' => 'Tanda Terima Faktur Pembelian #',
//			'value' => $purchaseCheque->purchaseReceiptHeader->number,
//		),
//		array(
//			'label' => 'Tanggal Terima Faktur Pembelian',
//			'value' => $purchaseCheque->purchaseReceiptHeader->date,
//		),
//		array(
//			'label' => 'Supplier',
//			'value' => $purchaseCheque->purchaseReceiptHeader->supplier->company,
//		),
	),
)); ?>

<br/>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseCheque-detail-grid',
	'dataProvider'=>new CArrayDataProvider($purchaseCheque->purchaseChequeDetails),
	'columns'=>array(
		'purchaseReceiptHeader.number: Nomor Faktur',
		array(
			'header'=>'Total Penerimaan',
			'value'=>'number_format($data->purchaseReceiptHeader->totalPurchase, 2)',
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
    <?php echo CHtml::link('Edit', array('create', 'id'=>$purchaseCheque->id)); ?>
    <?php echo CHtml::link('Print Purchase Cheque', array('memo', 'id'=>$purchaseCheque->id), array('target'=>'_blank')); ?>
</div>