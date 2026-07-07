<?php
$this->breadcrumbs=array(
	'Input Data Indent'=>array('create'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create IndentHeader', 'url'=>array('create')),
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

<h1>Manage Indent Headers</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'indent-header-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
<br />
<div style="text-align: right">
        <?php echo CHtml::link('Buat Data Inden', array('/transaction/indent/create')); ?>
</div>