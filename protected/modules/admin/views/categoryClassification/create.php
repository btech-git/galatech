<?php
$this->breadcrumbs=array(
	'Category Classifications'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Classification', 'url'=>array('admin')),
);
?>

<h1>Create Category Classification</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>