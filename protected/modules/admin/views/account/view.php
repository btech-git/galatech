<?php
$this->breadcrumbs=array(
	'Accounts'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Account', 'url'=>array('create')),
	array('label'=>'Update Account', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Account', 'url'=>array('admin')),
);
?>

<h1>View Account #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Kategori',
			'value'=>$model->accountCategory->name,
		),
		'code',
		'name',
		'description',
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
