<?php
$this->breadcrumbs=array(
	'Category Classification Varieties'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Classification Variety', 'url'=>array('create')),
	array('label'=>'View Category Classification Variety', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Classification Variety', 'url'=>array('admin')),
);
?>

<h1>Update Category Classification Variety <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>