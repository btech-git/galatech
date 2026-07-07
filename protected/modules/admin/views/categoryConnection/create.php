<?php
$this->breadcrumbs=array(
	'Category Connections'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Connection', 'url'=>array('admin')),
);
?>

<h1>Create Category Connection</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>