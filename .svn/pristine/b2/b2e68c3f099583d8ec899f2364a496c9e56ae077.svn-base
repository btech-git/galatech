<?php
$this->breadcrumbs=array(
	'Category Varieties'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Variety', 'url'=>array('create')),
	array('label'=>'Update Category Variety', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Variety', 'url'=>array('admin')),
);
?>

<h1>View Category Variety #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Variety',
			'value'=>$model->variety->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
