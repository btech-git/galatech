<?php
$this->breadcrumbs=array(
	'Category Brand Discs'=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Category Brand Disc', 'url'=>array('create')),
	array('label'=>'Update Category Brand Disc', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand Disc', 'url'=>array('admin')),
);
?>

<h1>View Category Brand Disc #<?php echo $model->id; ?></h1>

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
			'label'=>'Disc',
			'value'=>$model->discMaterial->name,
		),
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
