<?php
$this->breadcrumbs=array(
	'Purchase Payment'=>array('/transaction/purchasePayment/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . "Pengeluaran Bank"; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$purchasePayment,
	'attributes'=>array(
		array(
			'label'=>'Pembayaran #',
			'value'=>$purchasePayment->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $purchasePayment->date),
		),
		array(
			'label'=>'Supplier',
			'value'=>$purchasePayment->supplier->company,
		),
		array(
			'label'=>'Catatan',
			'value'=>$purchasePayment->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-detail-grid',
	'dataProvider'=>new CArrayDataProvider($purchasePayment->purchasePaymentDetailRevs),
	'columns'=>array(
		'purchaseReceiptHeader.number: Tanda Terima Pembelian #',
		array(
			'header' => 'Tanggal',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->purchaseReceiptHeader->date)',
		),
		'account.name: Nama Akun',
		 array(
			'header'=>'Total',
			'value'=>'number_format($data->purchaseReceiptHeader->totalPurchase, 2)',
			'htmlOptions'=>array(
					'style'=>'text-align: right',
			),
		),
		array(
			'header'=>'Jumlah',
			'value'=>'number_format($data->amount, 2)',
			'htmlOptions'=>array(
				'style'=>'text-align: right',
			),
		),
		'memo',
	),
)); ?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'purchasePayment-extra-grid',
    'dataProvider' => new CArrayDataProvider($purchasePayment->purchasePaymentExtras),
    'columns' => array(
		'account.name: Nama Akun',
        array(
            'header' => 'Jumlah',
            'value' => 'number_format($data->amount, 2)',
            'htmlOptions' => array(
                'style' => 'text-align: right',
            ),
        ),
		'memo: Memo',
    ),
));
?>

<div id="link">
    <?php echo CHtml::link('Create', array('create')); ?>
    <?php echo CHtml::link('Manage', array('admin')); ?>
    <?php echo CHtml::link('Edit', array('create', 'id'=>$purchasePayment->id)); ?>
	<?php echo CHtml::link('Print Nota Pembayaran Pembelian', array('memo', 'id'=>$purchasePayment->id), array('target'=>'_blank')); ?>
</div>