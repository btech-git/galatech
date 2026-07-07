<?php
$this->breadcrumbs=array(
	'Category Classification Varieties'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Classification Variety', 'url'=>array('create')),
	array('label'=>'Update Category Classification Variety', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Classification Variety', 'url'=>array('admin')),
);
?>

<h1>View Category Classification Variety #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                        'label'=>'Category Classification',
                        'value'=>$model->categoryClassification->name,
                ),
                array(
                        'label'=>'Jenis',
                        'value'=>$model->variety->name,
                ),
		array(
			'label'=>'Jenis',
			'value'=>$model->variety->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
