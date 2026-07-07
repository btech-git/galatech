<?php
$this->breadcrumbs=array(
	'Category Brands'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Brand', 'url'=>array('create')),
	array('label'=>'View Category Brand', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand', 'url'=>array('admin')),
);
?>

<h1>Update Category Brand <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>