<?php
$this->breadcrumbs=array(
	'Category Specifications'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Specification', 'url'=>array('create')),
	array('label'=>'View Category Specification', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Specification', 'url'=>array('admin')),
);
?>

<h1>Update Category Specification <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>