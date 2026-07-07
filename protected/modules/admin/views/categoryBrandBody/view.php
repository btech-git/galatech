<?php
$this->breadcrumbs=array(
	'Category Brand Bodys'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Brand Body', 'url'=>array('create')),
	array('label'=>'Update Category Brand Body', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand Body', 'url'=>array('admin')),
);
?>

<h1>View Category Brand Body #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
				'label'=>'Category Brand',
				'value'=>$model->categoryBrand->name,
		),
		array(
                        'label'=>'Body',
                        'value'=>$model->bodyType->name,
                ),
		array(
                        'label'=>'Status',
                        'value'=>$model->status(),
                ),
	),
)); ?>
