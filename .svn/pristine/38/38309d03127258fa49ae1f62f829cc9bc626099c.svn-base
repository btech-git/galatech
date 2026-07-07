<?php
$this->breadcrumbs=array(
	'Category Material Grade Thicknesses'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Material Grade Thickness', 'url'=>array('create')),
	array('label'=>'Update Category Material Grade Thickness', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Material Grade Thickness', 'url'=>array('admin')),
);
?>

<h1>View Category Material Grade Thickness #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                        'label'=>'Category Material Grade Thickness',
                        'value'=>$model->categoryMaterialGrade->name,
                ),
                array(
                        'label'=>'Thickness',
                        'value'=>$model->thickness->name,
                ),
		array(
			'label'=>'Grade',
			'value'=>$model->categoryMaterialGrade->grade->name,
		),
		array(
			'label'=>'Thickness',
			'value'=>$model->thickness->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
