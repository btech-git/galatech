<?php
$this->breadcrumbs=array(
	'Category Types'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Type', 'url'=>array('create')),
	array('label'=>'View Category Type', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Type', 'url'=>array('admin')),
);
?>

<h1>Update Category Type <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>