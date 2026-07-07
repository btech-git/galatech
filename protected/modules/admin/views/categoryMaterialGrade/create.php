<?php
$this->breadcrumbs=array(
	'Category Material Grades'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Material Grade', 'url'=>array('admin')),
);
?>

<h1>Create Category Material Grade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>