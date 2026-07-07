<h1>Kelola Data Retur Penjualan Barang</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'return-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$salesReturnHeader,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
		array(
			'name' => 'invoice_header_id',
			'header' => 'Invoice #',
			'filter' => false, //CHtml::listData(InvoiceHeader::model()->findAll(), 'id', 'number'),
			'value' => '$data->invoiceHeader->codeNumber',
		),
//		array(
//			'name' => 'warehouse_id',
//			'filter' => CHtml::listData(Warehouse::model()->findAll(), 'id', 'name'),
//			'value' => '$data->warehouse->name',
//		),
		array(
			'header' => 'Customer',
			'filter' => CHtml::dropDownList('CustomerId', $customerId, CHtml::listData(Customer::model()->findAll(array('order' => 'company ASC')), 'id', 'company'), array('empty'=>'')),
			'value' => '$data->invoiceHeader->deliveryHeader->customer->company',
		),
		array(
			'class'=>'CButtonColumn',
			'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
