<?php
$this->pageTitle=Yii::app()->name . ' - Galatech';
$this->breadcrumbs=array(
	'Galatech',
);
Yii::app()->clientScript->registerScript('transaction', "
	if (!document.getElementById('purchase-ul').getElementsByTagName('li').length)
		document.getElementById('purchase-fieldset').style.display = 'none';
	if (!document.getElementById('sales-ul').getElementsByTagName('li').length)
		document.getElementById('sales-fieldset').style.display = 'none';
	if (!document.getElementById('accounting-ul').getElementsByTagName('li').length)
		document.getElementById('accounting-fieldset').style.display = 'none';
");
?>
<h1>Revisi Transaksi</h1>

<div class="form">        
        <fieldset id="purchase-fieldset">
            <legend>Pembelian</legend>
            <ul id="purchase-ul" style="display: table-cell">
               <?php if (Yii::app()->user->checkAccess('tPurchaseEdit') || Yii::app()->user->checkAccess('tsPurchaseEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Pembelian', array('/transaction/purchase/admin')); ?><br/><br/></li>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess('tReceiveEdit') || Yii::app()->user->checkAccess('tsReceiveEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Penerimaan', array('/transaction/receive/admin')); ?><br/><br/></li>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess('tPurchaseReturnEdit') || Yii::app()->user->checkAccess('tsPurchaseReturnEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Retur Pembelian', array('/transaction/purchaseReturn/admin')); ?><br/><br/></li>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess('tPurchasePaymentEdit') || Yii::app()->user->checkAccess('tsPurchasePaymentEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Pembayaran Pembelian', array('/transaction/purchasePayment/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Tanda Terima Pembelian', array('/transaction/purchaseReceipt/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Pengeluaran Giro Pembelian', array('/transaction/purchaseCheque/admin')); ?></li>
                <?php endif; ?>
            </ul>
        </fieldset>
        <fieldset id="sales-fieldset">
            <legend>Penjualan</legend>
            <ul id="sales-ul" style="display: table-cell">
                <?php if (Yii::app()->user->checkAccess('tInvoiceEdit') || Yii::app()->user->checkAccess('tsInvoiceEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Inden Barang', array('/transaction/indent/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Uang Muka Penjualan', array('/transaction/salesDownpayment/admin')); ?><br/><br/></li>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess('tDeliveryEdit') || Yii::app()->user->checkAccess('tsDeliveryEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Pengiriman Barang', array('/transaction/delivery/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Invoice', array('/transaction/invoice/admin')); ?><br/><br/></li>
                <?php endif; ?>   
                <?php if (Yii::app()->user->checkAccess('tSalesReturnEdit') || Yii::app()->user->checkAccess('tsSalesReturnEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Retur Penjualan', array('/transaction/salesReturn/admin')); ?><br/><br/></li>
                <?php endif; ?>
                <?php if (Yii::app()->user->checkAccess('tSalesPaymentEdit') || Yii::app()->user->checkAccess('tsSalesPaymentEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Pembayaran Penjualan', array('/transaction/salesPayment/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Tanda Terima Penjualan', array('/transaction/receipt/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Penerimaan Giro Penjualan', array('/transaction/salesCheque/admin')); ?></li>
                <?php endif; ?>
            </ul>
        </fieldset>
        <fieldset id="accounting-fieldset">
            <legend>Akuntansi</legend>
            <ul id="accounting-ul" style="display: table-cell">
                <?php if (Yii::app()->user->checkAccess('tAccountingEdit') || Yii::app()->user->checkAccess('tsAccountingEdit')): ?>
                    <li><?php echo CHtml::link('Revisi Penerimaan Faktur Pembelian', array('/transaction/purchaseInvoice/admin')); ?><br/><br/></li>	
                    <li><?php echo CHtml::link('Revisi Pengeluaran Kas/Bank', array('/transaction/expense/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Pemasukan Kas/Bank', array('/transaction/deposit/admin')); ?><br/><br/></li>
                    <li><?php echo CHtml::link('Revisi Jurnal Penyesuaian', array('/transaction/journalVoucher/admin')); ?><br/><br/></li>
                <?php endif; ?>
            </ul>
        </fieldset>
        <fieldset id="warehouse-fieldset">
            <legend>Gudang</legend>
            <ul id="warehouse-ul" style="display: table-cell">
                <?php if (Yii::app()->user->checkAccess('administrator')): ?>
                    <li><?php echo CHtml::link('Revisi Transfer', array('/transaction/transfer/admin')); ?><br/><br/></li>	
                <?php endif; ?>
            </ul>
        </fieldset>
</div>
