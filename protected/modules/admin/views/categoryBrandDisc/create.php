<?php
$this->breadcrumbs=array(
	'Category Brand Discs'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Category Brand Disc', 'url'=>array('admin')),
);
?>

<h1>Create Category Brand Disc</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>