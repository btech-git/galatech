<?php
$this->breadcrumbs=array(
	'Category Material Grades'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Material Grade', 'url'=>array('create')),
	array('label'=>'Update Category Material Grade', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Material Grade', 'url'=>array('admin')),
);
?>

<h1>View Category Material Grade #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                        'label'=>'Category Material',
                        'value'=>$model->categoryMaterial->name,
                ),
                array(
                        'label'=>'Grade',
                        'value'=>$model->grade->name,
                ),
		array(
			'label'=>'Grade',
			'value'=>$model->grade->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
