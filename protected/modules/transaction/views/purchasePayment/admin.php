<h1>Kelola Data Pembayaran Pembelian Barang</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$purchasePayment,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
//		array(
//			'name' => 'purchase_receipt_header_id',
//			'filter' => CHtml::listData(PurchaseReceiptHeader::model()->findAll(), 'id', 'number'),
//			'value' => '$data->purchaseReceiptHeader->number',
//		),
		array(
			'name' => 'supplier_id',
			'filter' => CHtml::listData(Supplier::model()->findAll(array('order' => 'company ASC')), 'id', 'company'),
			'value' => '$data->supplier->company',
		),
		array(
			'name'=>'is_inactive',
			'filter' => array(ActiveRecord::ACTIVE=>'Active', ActiveRecord::INACTIVE=>'Inactive'),
			'value'=>'$data->status()',
		),
		array(
			'class'=>'CButtonColumn',
				'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
