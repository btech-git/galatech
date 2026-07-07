<?php
$this->breadcrumbs=array(
	'Customers'=>array('create'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Customer', 'url'=>array('create')),
	array('label'=>'Update Customer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Manage Customer', 'url'=>array('admin')),
);
?>

<h1>View Customer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company',
		'name',
		array(
			'label'=>'Account',
			'value'=>($model->account === null) ? '' : $model->account->name,
		),
		'address',
		'phone',
		'fax',
		'npwp',
		'email',
		'website',
		'note',
		array(
			'label'=>'Status',
			'value'=>$model->status(),
		),
	),
)); ?>
