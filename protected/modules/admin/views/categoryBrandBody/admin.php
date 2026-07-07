<?php
$this->breadcrumbs=array(
	'Category Brand Bodys'=>array('create'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Category Brand Body', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-brand-body-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Category Brand Bodys</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-brand-body-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'category_brand_id',
			'filter' => CHtml::listData(CategoryBrand::model()->findAll(), 'id', 'name'),
			'value' => '$data->categoryBrand->name',
		),
		array(
			'name' => 'body_type_id',
			'filter' => CHtml::listData(BodyType::model()->findAll(), 'id', 'name'),
			'value' => '$data->bodyType->name',
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
