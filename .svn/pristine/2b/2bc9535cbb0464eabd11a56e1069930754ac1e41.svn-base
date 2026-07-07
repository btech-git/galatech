<?php
$this->breadcrumbs=array(
	'Category Brand Handlings'=>array('create'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Category Brand Handling', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-brand-handling-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Category Brand Handlings</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-brand-handling-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'category_brand_id',
			'filter' => CHtml::listData(CategoryBrand::model()->findAll(), 'id', 'name'),
			'value' => '$data->categoryBrand->name',
		),
		array(
			'name' => 'handling_id',
			'filter' => CHtml::listData(Handling::model()->findAll(), 'id', 'name'),
			'value' => '$data->handling->name',
		),
		array(
			'name'=>'is_inactive',
			'filter' => array(ActiveRecord::ACTIVE=>'Active', ActiveRecord::INACTIVE=>'Inactive'),
			'value'=>'$data->status()',
		),
		array(
			'class'=>'CButtonColumn',
				'template'=>'{view},{update}',
		),
	),
)); ?>
