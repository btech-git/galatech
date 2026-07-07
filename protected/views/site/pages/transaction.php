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
	<fieldset id="purchase-fieldset">
		<legend>Pembelian</legend>
		<ul id="purchase-ul" style="display: table-cell; width: 800px">
			<?php if (Yii::app()->user->checkAccess('tPurchaseCreate') || Yii::app()->user->checkAccess('tsPurchaseCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Pemesanan Pembelian', array('/transaction/purchase/create')); ?>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntPurchaseCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Pemesanan Pembelian N', array('/transaction/purchase/create', 'nt'=>1)); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (Yii::app()->user->checkAccess('tReceiveCreate') || Yii::app()->user->checkAccess('tsReceiveCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Penerimaan Barang', array('/transaction/receive/create')); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntReceiveCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Penerimaan Barang N', array('/transaction/receive/create&nt=1')); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (Yii::app()->user->checkAccess('tPurchaseReturnCreate') || Yii::app()->user->checkAccess('tsPurchaseReturnCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Retur Pembelian', array('/transaction/purchaseReturn/create')); ?>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntPurchaseReturnCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Retur Pembelian N', array('/transaction/purchaseReturn/create', 'nt'=>1)); ?><br/><br/>
				</li>			
			<?php endif; ?>
		</ul>
	</fieldset>

	<fieldset id="warehouse-fieldset">
		<legend>Gudang</legend>
		<ul id="warehouse-ul" style="display: table-cell; width: 800px">
			<?php if (Yii::app()->user->checkAccess('tWarehouseCreate') || Yii::app()->user->checkAccess('tsWarehouseCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Stok Adjustment', array('/transaction/adjustment/create')); ?>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntWarehouseCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Stok Adjustment N', array('/transaction/adjustment/create&nt=1')); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('tsWarehouseCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Stok Transfer', array('/transaction/transfer/create')); ?>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntWarehouseCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Stok Transfer N', array('/transaction/transfer/create&nt=1')); ?><br/><br/>
				</li>
			<?php endif; ?>
		</ul>
	</fieldset>

	<fieldset id="sales-fieldset">
		<legend>Penjualan</legend>
		<ul id="sales-ul" style="display: table-cell; width: 800px">
			<?php if (Yii::app()->user->checkAccess('tDeliveryCreate') || Yii::app()->user->checkAccess('tsDeliveryCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Inden Barang', array('/transaction/indent/create')); ?>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntDeliveryCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Inden Barang N', array('/transaction/indent/create', 'nt'=>1)); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (Yii::app()->user->checkAccess('tSalesDownpaymentCreate') || Yii::app()->user->checkAccess('tsSalesDownpaymentCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Uang Muka Penjualan', array('/transaction/salesDownpayment/create')); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntSalesDownpaymentCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Uang Muka Penjualan N', array('/transaction/salesDownpayment/create', 'nt'=>1)); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (Yii::app()->user->checkAccess('tDeliveryCreate') || Yii::app()->user->checkAccess('tsDeliveryCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Pengiriman Barang', array('/transaction/delivery/create')); ?>
				</li> 
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntDeliveryCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Pengiriman Barang N', array('/transaction/delivery/create', 'nt'=>1)); ?><br/><br/>
				</li>
			<?php endif; ?>
			<?php if (Yii::app()->user->checkAccess('tSalesReturnCreate') || Yii::app()->user->checkAccess('tsSalesReturnCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Retur Penjualan', array('/transaction/salesReturn/create')); ?>
				</li>  
			<?php endif; ?>
			<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntSalesReturnCreate')): ?>
				<li class="left" style="width: 50%">
					<?php echo CHtml::link('Retur Penjualan N', array('/transaction/salesReturn/create', 'nt'=>1)); ?><br/><br/>
				</li>
			<?php endif; ?>
		</ul>
	</fieldset>
</div>
