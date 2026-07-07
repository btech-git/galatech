<h1>Kelola Data Pembayaran Penjualan Barang</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$salesPayment,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
		array(
			'name' => 'customer_id',
			'filter' => CHtml::listData(Customer::model()->findAll(array('order' => 'company ASC')), 'id', 'company'),
			'value' => '$data->customer->company',
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
