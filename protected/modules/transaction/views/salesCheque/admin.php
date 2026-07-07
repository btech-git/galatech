<h1>Kelola Pengeluaran Giro Penjualan</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseInvoice-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$salesCheque,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal Keluar',
			'name' => 'receive_date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->receive_date)'
		),
		array(
			'header' => 'Jatuh Tempo',
			'name' => 'due_date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->due_date)'
		),
		array(
			'header' => 'Customer',
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
