<h1>Kelola Data Retur Pembelian Barang</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'return-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$purchaseReturn,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
		array(
			'name' => 'purchase_invoice_id',
			'filter' => false, //CHtml::listData(PurchaseInvoice::model()->findAll(), 'id', 'number'),
			'value' => '($data->purchaseInvoice === null) ? "" : $data->purchaseInvoice->number',
		),
		array(
			'name' => 'warehouse_id',
			'filter' => CHtml::dropDownList('WarehouseId', $warehouseId, CHtml::listData(Warehouse::model()->findAll(), 'id', 'name'), array('empty'=>'')),
			'value' => '($data->warehouse === null) ? "" : $data->warehouse->name',
		),
		array(
			'header' => 'Supplier',
			'filter' => CHtml::dropDownList('SupplierId', $supplierId, CHtml::listData(Supplier::model()->findAll(array('order' => 'company ASC')), 'id', 'name'), array('empty'=>'')),
			'value' => '$data->purchaseInvoice->purchaseHeader->supplier->name',
		),
		array(
			'class'=>'CButtonColumn',
			'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
