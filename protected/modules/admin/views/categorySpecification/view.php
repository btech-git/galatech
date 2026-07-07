<?php
$this->breadcrumbs=array(
	'Category Specifications'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Specification', 'url'=>array('create')),
	array('label'=>'Update Category Specification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Specification', 'url'=>array('admin')),
);
?>

<h1>View Category Specification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Specification',
			'value'=>$model->specification->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
