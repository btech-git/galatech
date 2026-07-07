<?php
$this->breadcrumbs=array(
	'Category Material Grade Thicknesses'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Material Grade Thickness', 'url'=>array('admin')),
);
?>

<h1>Create Category Material Grade Thickness</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>