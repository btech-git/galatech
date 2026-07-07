<?php
$this->breadcrumbs=array(
	'Category Grades'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Grade', 'url'=>array('admin')),
);
?>

<h1>Create Category Grade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>