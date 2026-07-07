<h1>Kelola Pengeluaran Giro Pembelian</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseInvoice-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$purchaseCheque,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal Terima',
			'name' => 'issue_date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->issue_date)'
		),
		array(
			'header' => 'Jatuh Tempo',
			'name' => 'due_date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->due_date)'
		),
		array(
			'header' => 'Supplier',
			'name' => 'supplier_id',
			'filter' => CHtml::listData(Supplier::model()->findAll(array('order' => 'company ASC')), 'id', 'company'),
			'value' => 'CHtml::value($data, "supplier.company")',
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
