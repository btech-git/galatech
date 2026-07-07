<?php
$this->breadcrumbs=array(
	'Category Material Grade Brands'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Material Grade Brand', 'url'=>array('create')),
	array('label'=>'Update Category Material Grade Brand', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Material Grade Brand', 'url'=>array('admin')),
);
?>

<h1>View Category Material Grade Brand #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
                        'label'=>'Category Material Grade',
                        'value'=>$model->categoryMaterialGrade->name,
                ),
                array(
                        'label'=>'Brand',
                        'value'=>$model->brand->name,
                ),
		array(
			'label'=>'Grade',
			'value'=>$model->categoryMaterialGrade->grade->name,
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
