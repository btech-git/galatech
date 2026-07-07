<?php
$this->breadcrumbs=array(
	'Disc Materials'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Disc Material', 'url'=>array('create')),
	array('label'=>'Update Disc Material', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Disc Material', 'url'=>array('admin')),
);
?>

<h1>View Disc Material #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
