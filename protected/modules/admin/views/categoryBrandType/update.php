<?php
$this->breadcrumbs=array(
	'Category Brand Types'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Category Brand Type', 'url'=>array('create')),
	array('label'=>'View Category Brand Type', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Category Brand Type', 'url'=>array('admin')),
);
?>

<h1>Update Category Brand Type <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>