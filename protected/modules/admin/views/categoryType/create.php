<?php
$this->breadcrumbs=array(
	'Category Types'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Type', 'url'=>array('admin')),
);
?>

<h1>Create Category Type</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>