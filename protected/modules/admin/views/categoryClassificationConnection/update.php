<?php
$this->breadcrumbs=array(
	'Category Classification Connections'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Classification Connection', 'url'=>array('create')),
	array('label'=>'View Category Classification Connection', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Classification Connection', 'url'=>array('admin')),
);
?>

<h1>Update Category Classification Connection <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>