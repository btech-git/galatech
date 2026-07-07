<?php
$this->breadcrumbs=array(
	'Category Brand Bodys'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Brand Body', 'url'=>array('admin')),
);
?>

<h1>Create Category Brand Body</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>