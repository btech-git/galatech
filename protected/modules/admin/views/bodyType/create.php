<?php
$this->breadcrumbs=array(
	'Body Types'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Body Type', 'url'=>array('admin')),
);
?>

<h1>Create Body Type</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>