<h1>Kelola Data Tanda Terima</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'receipt-grid',
	'dataProvider'=>$receipt->search(),
	'filter'=>$receipt,
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
			'class'=>'CButtonColumn',
			'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
