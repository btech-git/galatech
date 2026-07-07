<?php
$this->breadcrumbs=array(
	'Category Materials'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Material', 'url'=>array('create')),
	array('label'=>'Update Category Material', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Material', 'url'=>array('admin')),
);
?>

<h1>View Category Material #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
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
