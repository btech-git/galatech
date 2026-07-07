<h1>Kelola Data Tanda Terima Pembelian Barang</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseReceipt-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$purchaseReceipt,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
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
