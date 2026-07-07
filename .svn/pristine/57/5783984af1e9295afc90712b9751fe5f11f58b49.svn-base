<?php
$this->breadcrumbs=array(
	'Category Classification Materials'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Classification Material', 'url'=>array('create')),
	array('label'=>'Update Category Classification Material', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Classification Material', 'url'=>array('admin')),
);
?>

<h1>View Category Classification Material #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category Classification',
			'value'=>$model->categoryClassification->name,
		),
		array(
			'label'=>'Material',
			'value'=>$model->material->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
