<?php
$this->pageTitle = Yii::app()->name . ' - Galatech';
$this->breadcrumbs = array(
	'Galatech',
);
Yii::app()->clientScript->registerScript('transaction', "
	if (!document.getElementById('purchase-ul').getElementsByTagName('li').length)
		document.getElementById('purchase-fieldset').style.display = 'none';
	if (!document.getElementById('warehouse-ul').getElementsByTagName('li').length)
		document.getElementById('warehouse-fieldset').style.display = 'none';
	if (!document.getElementById('sales-ul').getElementsByTagName('li').length)
		document.getElementById('sales-fieldset').style.display = 'none';
");
?>
<h1>Data Transaksi</h1>

<div class="form">        
	<fieldset id="warehouse-fieldset">
		<legend>Gudang</legend>
		<ul id="warehouse-ul" style="display: table-cell; width: 800px">
			<?php if (Yii::app()->user->checkAccess('tDeliveryView') || Yii::app()->user->checkAccess('tsDeliveryView') || Yii::app()->user->checkAccess('ntDeliveryView')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Surat Jalan', array('/transaction/deliveryWarehouse/admin')); ?>
				</li>
			<?php endif; ?>
			<?php if (Yii::app()->user->checkAccess('tTransferCreate') || Yii::app()->user->checkAccess('tsTransferCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Stok Transfer', array('/transaction/transfer/create')); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntTransferCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Stok Transfer N', array('/transaction/transfer/create&nt=1')); ?><br/><br/>
				</li>
			<?php endif; ?>
				
			<?php if (Yii::app()->user->checkAccess('tTransferPrint')
				|| Yii::app()->user->checkAccess('tsTransferPrint') 
				|| Yii::app()->user->checkAccess('ntTransferPrint') ): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Transfer admin', array('/transaction/transfer/admin')); ?><br/><br/>
				</li>
			<?php endif; ?>
		</ul>
	</fieldset>
</div>
