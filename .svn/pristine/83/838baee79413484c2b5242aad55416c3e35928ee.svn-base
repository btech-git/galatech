<?php
$this->breadcrumbs=array(
	'SalesAsset'=>array('/transaction/salesAsset/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$salesAsset,
	'attributes'=>array(
		array(
                        'label'=>'Penjualan #',
                        'value'=>$salesAsset->number,
                ),
                array(
                        'label'=>'Tanggal',
                        'value'=>$salesAsset->date,
                ),
                array(
                        'label'=>'Customer',
                        'value'=>$salesAsset->customer,
                ),
                array(
                        'label'=>'Catatan',
                        'value'=>$salesAsset->note,
                ),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'salesAsset-detail-grid',
	'dataProvider'=>new CArrayDataProvider($salesAsset->salesAssetDetails),
	'columns'=>array(
                'asset_name: Nama Barang',
                array(
                        'header'=>'Jumlah',
                        'value'=>'number_format($data->quantity, 0)',
                        'htmlOptions'=>array(
                                'style'=>'text-align: right',
                        ),
                ),
                array(
                        'header'=>'Harga Satuan',
                        'value'=>'number_format($data->unit_price, 2)',
                        'htmlOptions'=>array(
                                'style'=>'text-align: right',
                        ),
                ),
                array(
                        'header'=>'Total',
                        'value'=>'number_format($data->total, 2)',
                        'htmlOptions'=>array(
                                'style'=>'text-align: right',
                        ),
                ),
	),
)); ?>

<div>
        <?php echo CHtml::link('Print Nota Penjualan Asset', array('memo', 'id'=>$salesAsset->id), array('target'=>'_blank')); ?>
</div>