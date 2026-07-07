<h1>Kelola Data Jurnal Penyesuaian</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'jurnal-voucher-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$journal,
	'columns'=>array(
		'number',
		array(
			'header' => 'Tanggal',
			'name' => 'date',
			'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy", $data->date)'
		),
		'note',
		array(
			'name'=>'is_inactive',
			'filter' => array(ActiveRecord::ACTIVE=>'Active', ActiveRecord::INACTIVE=>'Inactive'),
			'value'=>'$data->status()',
		),
		array(
			'class'=>'CButtonColumn',
			'updateButtonUrl'=>'CHtml::normalizeUrl(array("create", "id"=>$data->id))',
		),
	),
)); ?>
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
