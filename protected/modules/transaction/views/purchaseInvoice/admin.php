<h1>Kelola Penerimaan Faktur Pembelian</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseInvoice-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$purchaseInvoice,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
		'reference',
		array(
			'name' => 'purchase_header_id',
			'filter' => false, //CHtml::listData(PurchaseHeader::model()->findAll(), 'id', 'number'),
			'value' => '$data->purchaseHeader->number',
		),
////                 array(
//                        'name' => 'warehouse_id',
//                        'filter' => CHtml::listData(Warehouse::model()->findAll(), 'id', 'name'),
//                        'value' => '$data->warehouse->name',
//                ),
			array(
				'header' => 'Supplier',
				'filter' => CHtml::dropDownList('SupplierId', $supplierId, CHtml::listData(Supplier::model()->findAll(array('order' => 'company ASC')), 'id', 'company'), array('empty'=>'')),
				'value' => '$data->purchaseHeader->supplier->company',
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
