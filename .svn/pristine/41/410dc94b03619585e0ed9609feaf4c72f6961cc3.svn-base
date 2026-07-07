<?php
$this->breadcrumbs=array(
	'Body Types'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Body Type', 'url'=>array('create')),
	array('label'=>'Update Body Type', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Body Type', 'url'=>array('admin')),
);
?>

<h1>View Body Type #<?php echo $model->id; ?></h1>

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
