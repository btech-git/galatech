<?php
$this->breadcrumbs=array(
	'Category Thicknesses'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Thickness', 'url'=>array('admin')),
);
?>

<h1>Create Category Thickness</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>