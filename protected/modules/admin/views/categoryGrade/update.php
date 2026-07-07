<?php
$this->breadcrumbs=array(
	'Category Grades'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Grade', 'url'=>array('create')),
	array('label'=>'View Category Grade', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Grade', 'url'=>array('admin')),
);
?>

<h1>Update Category Grade <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>