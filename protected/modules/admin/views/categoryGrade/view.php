<?php
$this->breadcrumbs=array(
	'Category Grades'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Grade', 'url'=>array('create')),
	array('label'=>'Update Category Grade', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Grade', 'url'=>array('admin')),
);
?>

<h1>View Category Grade #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Grade',
			'value'=>$model->grade->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
