<?php
$this->breadcrumbs=array(
	'Category Brand Handlings'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Brand Handling', 'url'=>array('create')),
	array('label'=>'Update Category Brand Handling', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand Handling', 'url'=>array('admin')),
);
?>

<h1>View Category Brand Handling #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category Brand',
			'value'=>$model->categoryBrand->name,
		),
		array(
			'label'=>'Handling',
			'value'=>$model->handling->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
