<?php
$this->breadcrumbs=array(
	'Disc Materials'=>array('admin'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Disc Material', 'url'=>array('create')),
	array('label'=>'View Disc Material', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Disc Material', 'url'=>array('admin')),
);
?>

<h1>Update Disc Material <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>