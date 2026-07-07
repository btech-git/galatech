<?php
$this->breadcrumbs=array(
	'Sales Payment'=>array('/transaction/salesPayment/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . "Penerimaan Bank"; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$salesPayment,
	'attributes'=>array(
		array(
			'label'=>'Pelunasan #',
			'value'=>$salesPayment->number,
		),
		array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $salesPayment->date),
		),
		array(
			'label'=>'Customer',
			'value'=>$salesPayment->customer->company,
		),
		array(
			'label'=>'Catatan',
			'value'=>$salesPayment->note,
		),
		
		
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-detail-grid',
	'dataProvider'=>new CArrayDataProvider($salesPayment->salesPaymentDetailRevs),
	'columns'=>array(
//		'account.name: Nama Akun',
		'receiptHeader.number: Tanda Terima Penjualan #',
		array(
			'header' => 'Tanggal',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->receiptHeader->date)',
		),
		'account.name: Nama Akun',
		 array(
			'header'=>'Total',
			'value'=>'number_format($data->receiptHeader->totalInvoice, 2)',
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
    'id' => 'salesPayment-extra-grid',
    'dataProvider' => new CArrayDataProvider($salesPayment->salesPaymentExtras),
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
    <?php echo CHtml::link('Edit', array('create', 'id'=>$salesPayment->id)); ?>
	<?php echo CHtml::link('Print Nota Pembayaran Penjualan', array('memo', 'id'=>$salesPayment->id), array('target'=>'_blank')); ?>
</div>