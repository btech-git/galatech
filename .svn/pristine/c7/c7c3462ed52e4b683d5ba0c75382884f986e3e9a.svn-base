<h1>Kelola Data Pengeluaran Giro</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cheque-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$cheque,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal Terima',
			'name' => 'receive_date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->receive_date)'
		),
		array(
			'header' => 'Tanggal Akhir',
			'name' => 'due_date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->due_date)'
		),
		array(
			'name' => 'receipt_header_id',
			'filter' => CHtml::listData(ReceiptHeader::model()->findAll(), 'id', 'number'),
			'value' => '$data->receiptHeader->number',
		),
		array(
			'header' => 'Customer',
			'filter' => CHtml::dropDownList('CustomerId', $customerId, CHtml::listData(Customer::model()->findAll(), 'id', 'name'), array('empty'=>'')),
			'value' => '$data->receiptHeader->customer->company',
		),
		array(
			'class'=>'CButtonColumn',
			'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
