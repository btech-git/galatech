<?php
$this->breadcrumbs=array(
	'Category Brand Types'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Brand Type', 'url'=>array('admin')),
);
?>

<h1>Create Category Brand Type</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>