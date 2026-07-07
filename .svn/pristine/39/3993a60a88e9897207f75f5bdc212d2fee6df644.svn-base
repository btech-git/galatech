<?php
$this->breadcrumbs=array(
	'Category Thicknesses'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Thickness', 'url'=>array('create')),
	array('label'=>'Update Category Thickness', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Thickness', 'url'=>array('admin')),
);
?>

<h1>View Category Thickness #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Thickness',
			'value'=>$model->thickness->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
