<?php
$this->breadcrumbs=array(
	'TaxFormRevised'=>array('/transaction/taxFormRevised/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$taxFormRevised,
	'attributes'=>array(
		array(
		'label'=>'Pajak Revisi #',
		//'value'=>$taxFormRevised->number,
		),
	   array(
			'label'=>'Tanggal',
			'value'=>Yii::app()->dateFormatter->format("d MMMM yyyy", $taxFormRevised->date),
		),
		array(
			'label'=>'Catatan',
			'value'=>$taxFormRevised->note,
		),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchase-detail-grid',
	'dataProvider'=>new CArrayDataProvider($taxFormRevised->taxFormRevisedDetails),
	'columns'=>array(
		'name: Nama Item',
		'price: Jumlah',
	),
)); ?>

<div>
	<?php echo CHtml::link('Print Penerimaan Barang', array('memo', 'id'=>$taxFormRevised->id), array('target'=>'_blank')); ?>
</div>