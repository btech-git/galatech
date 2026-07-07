<?php
$this->breadcrumbs=array(
	'Category Brand Types'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Brand Type', 'url'=>array('create')),
	array('label'=>'Update Category Brand Type', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand Type', 'url'=>array('admin')),
);
?>

<h1>View Category Brand Type #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                        'label'=>'Category Brand',
                        'value'=>$model->categoryBrand->name,
                ),
		array(
			'label'=>'Brand',
			'value'=>$model->categoryBrand->brand->name,
		),
		array(
			'label'=>'Type',
			'value'=>$model->type->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
