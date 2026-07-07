<?php
$this->breadcrumbs=array(
	'Input Data Invoice'=>array('create'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Invoice', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('indent-header-grid', {
			data: $(this).serialize()
		});
		return false;
	});
");
?>

<h1>Manage Invoice</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::beginForm(array( '' ), 'get'); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indent-header-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$invoice,
	'columns'=>array(
		array(
			'id' => 'selectedIds',
			'class' => 'CCheckBoxColumn',
			'selectableRows' => '50', 
		),
		'number: Invoice#',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
		array(
			'name' => 'delivery_header_id',
			'header' => 'Pengiriman #',
			'filter' => false, //CHtml::listData(DeliveryHeader::model()->findAll(), 'id', 'number'),
			'value' => 'CHtml::value($data, "deliveryHeader.number")',
		),
		array(
			'header' => 'Pelanggan',
			'filter' => CHtml::dropDownList('CustomerId', $customerId, CHtml::listData(Customer::model()->findAll(array('order' => 'company ASC')), 'id', 'company'), array('empty'=>'')),
			'value' => 'CHtml::value($data, "deliveryHeader.customer.company")',
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
<?php echo CHtml::submitButton('Print Selected (Excel)', array('name' => 'SaveExcel', 'style' => 'float: right;', 'class'=>'grey-btn')); ?>
<?php echo CHtml::endForm(); ?>