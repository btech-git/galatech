<?php
$this->breadcrumbs=array(
	'Suppliers'=>array('admin'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Supplier', 'url'=>array('create')),
	array('label'=>'Update Supplier', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Supplier', 'url'=>array('admin')),
);
?>

<h1>View Supplier #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company',
		'name',
		array(
			'label'=>'Account',
			'value'=>($model->account === null ) ? '' : $model->account->name,
		),
		'address',
		'phone',
		'fax',
		'email',
		'website',
		'note',
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
