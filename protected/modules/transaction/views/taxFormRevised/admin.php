<h1>Kelola Pajak</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'receive-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$taxFormRevised,
	'columns'=>array(
//		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
//                array(
//                        'name' => 'purchase_header_id',
//                        'filter' => CHtml::listData(PurchaseHeader::model()->findAll(), 'id', 'number'),
//                        'value' => '$data->purchaseHeader->number',
//                ),
               
		array(
			'class'=>'CButtonColumn',
				'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
