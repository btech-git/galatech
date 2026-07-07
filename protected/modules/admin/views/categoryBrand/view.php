<?php
$this->breadcrumbs=array(
	'Category Brands'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Brand', 'url'=>array('create')),
	array('label'=>'Update Category Brand', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand', 'url'=>array('admin')),
);
?>

<h1>View Category Brand #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'label'=>'Category',
			'value'=>$model->category->name,
		),
		array(
			'label'=>'Brand',
			'value'=>$model->brand->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
