<?php
$this->breadcrumbs=array(
	'Purchase Asset'=>array('/transaction/purchaseAsset/create'),
	'View',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$purchaseAsset,
	'attributes'=>array(
		array(
                        'label'=>'Pembelian #',
                        'value'=>$purchaseAsset->number,
                ),
                array(
                        'label'=>'Tanggal',
                        'value'=>$purchaseAsset->date,
                ),
                array(
                        'label'=>'Supplier',
                        'value'=>$purchaseAsset->supplier,
                ),
                array(
                        'label'=>'Catatan',
                        'value'=>$purchaseAsset->note,
                ),
	),
)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseAsset-detail-grid',
	'dataProvider'=>new CArrayDataProvider($purchaseAsset->purchaseAssetDetails),
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
        <?php echo CHtml::link('Print Nota Pembelian Asset', array('memo', 'id'=>$purchaseAsset->id), array('target'=>'_blank')); ?>
</div>