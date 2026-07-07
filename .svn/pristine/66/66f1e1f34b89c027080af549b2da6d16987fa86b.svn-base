<?php
$this->breadcrumbs=array(
	'Category Classification Connections'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Classification Connection', 'url'=>array('create')),
	array('label'=>'Update Category Classification Connection', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Classification Connection', 'url'=>array('admin')),
);
?>

<h1>View Category Classification Connection #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                        'label'=>'Category Classification',
                        'value'=>$model->categoryClassification->name,
                ),
                array(
                        'label'=>'Connection',
                        'value'=>$model->connection->name,
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
