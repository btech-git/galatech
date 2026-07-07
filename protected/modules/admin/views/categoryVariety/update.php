<?php
$this->breadcrumbs=array(
	'Category Varieties'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Variety', 'url'=>array('create')),
	array('label'=>'View Category Variety', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Variety', 'url'=>array('admin')),
);
?>

<h1>Update Category Variety <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>