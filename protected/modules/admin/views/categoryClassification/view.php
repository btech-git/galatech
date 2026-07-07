<?php
$this->breadcrumbs=array(
	'Category Classifications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Classification', 'url'=>array('create')),
	array('label'=>'Update Category Classification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Classification', 'url'=>array('admin')),
);
?>

<h1>View Category Classification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Classification',
			'value'=>$model->classification->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
