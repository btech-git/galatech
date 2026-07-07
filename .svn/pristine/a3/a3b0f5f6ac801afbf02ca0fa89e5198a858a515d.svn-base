<?php
$this->breadcrumbs=array(
	'Category Connections'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Connection', 'url'=>array('create')),
	array('label'=>'Update Category Connection', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Connection', 'url'=>array('admin')),
);
?>

<h1>View Category Connection #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Connection',
			'value'=>$model->connection->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
