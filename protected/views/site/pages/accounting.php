<?php
$this->pageTitle=Yii::app()->name . ' - Galatech';
$this->breadcrumbs=array(
	'Galatech',
);
Yii::app()->clientScript->registerScript('transaction', "
	if (!document.getElementById('purchase-ul').getElementsByTagName('li').length)
		document.getElementById('purchase-fieldset').style.display = 'none';
	if (!document.getElementById('sale-ul').getElementsByTagName('li').length)
		document.getElementById('sale-fieldset').style.display = 'none';
	if (!document.getElementById('finance-ul').getElementsByTagName('li').length)
		document.getElementById('finance-fieldset').style.display = 'none';
");
?>
<h1>Transaksi Akuntansi</h1>

<div class="form">  
        <fieldset id="purchase-fieldset">
                <legend>Keuangan Pembelian</legend>
                <ul id="purchase-ul" style="display: table-cell">
					<?php if (!TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('tAccountingCreate')): ?>
						<li><?php echo CHtml::link('Penerimaan Faktur Pembelian', array('/transaction/purchaseInvoice/create')); ?><br/><br/></li>
						<li><?php echo CHtml::link('Tanda Terima Pembelian', array('/transaction/purchaseReceipt/create')); ?><br/><br/></li>
						<li><?php echo CHtml::link('Pengeluaran Giro Pembelian', array('/transaction/purchaseCheque/create')); ?><br/><br/></li>
						<li><?php echo CHtml::link('Pembayaran Pembelian', array('/transaction/purchasePayment/create')); ?><br/><br/></li>
					<?php endif; ?>
					<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntAccountingCreate')): ?>
						<li><?php echo CHtml::link('Penerimaan Faktur Pembelian N', array('/transaction/purchaseInvoice/create', 'nt'=>1)); ?><br/><br/></li>
						<li><?php echo CHtml::link('Tanda Terima Pembelian N', array('/transaction/purchaseReceipt/create', 'nt'=>1)); ?><br/><br/></li>
						<li><?php echo CHtml::link('Pengeluaran Giro Pembelian N', array('/transaction/purchaseCheque/create', 'nt'=>1)); ?><br/><br/></li>
						<li><?php echo CHtml::link('Pembayaran Pembelian N', array('/transaction/purchasePayment/create', 'nt'=>1)); ?><br/><br/></li>
					<?php endif; ?>
					
				</ul>
        </fieldset>
        
        <fieldset id="sale-fieldset">
                <legend>Keuangan Penjualan</legend>
				<ul id="sale-ul" style="display: table-cell">
					<?php if (!TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('tInvoiceCreate')): ?>
						<li><?php echo CHtml::link('Invoice', array('/transaction/invoice/create')); ?><br/><br/></li>
					<?php endif; ?>
					<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntInvoiceCreate')): ?>
						<li><?php echo CHtml::link('Invoice N', array('/transaction/invoice/create', 'nt'=>1)); ?><br/><br/></li>
					<?php endif; ?>
					<?php if (!TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('tAccountingCreate')): ?>
						<li><?php echo CHtml::link('Penerimaan Tanda Terima Penjualan', array('/transaction/receipt/create')); ?><br/><br/></li>
						<li><?php echo CHtml::link('Penerimaan Giro', array('/transaction/salesCheque/create')); ?><br/><br/></li>
						<li><?php echo CHtml::link('Pelunasan Penjualan', array('/transaction/salesPayment/create')); ?><br/><br/></li>
					<?php endif; ?>
					<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntAccountingCreate')): ?>
                        <li><?php echo CHtml::link('Penerimaan Tanda Terima Penjualan N', array('/transaction/receipt/create', 'nt'=>1)); ?><br/><br/></li>
                        <li><?php echo CHtml::link('Penerimaan Giro N', array('/transaction/salesCheque/create', 'nt'=>1)); ?><br/><br/></li>
                        <li><?php echo CHtml::link('Pelunasan Penjualan N', array('/transaction/salesPayment/create', 'nt'=>1)); ?><br/><br/></li>
				   <?php endif; ?>
				</ul>
		</fieldset>
	
        <fieldset id="finance-fieldset">
                <legend>Akuntansi</legend>
					 <ul id="finance-ul" style="display: table-cell">
						<?php if (!TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('tAccountingCreate')): ?>
							<li><?php echo CHtml::link('Pengeluaran Kas', array('/transaction/expense/create')); ?><br/><br/></li>
							<li><?php echo CHtml::link('Penerimaan Kas', array('/transaction/deposit/create')); ?><br/><br/></li>
							<li><?php echo CHtml::link('Pengeluaran Bank', array('/transaction/expense/create', 'bank' => 1)); ?><br/><br/></li>
							<li><?php echo CHtml::link('Penerimaan Bank', array('/transaction/deposit/create', 'bank' => 1)); ?><br/><br/></li>
							<li><?php echo CHtml::link('Jurnal Penyesuaian', array('/transaction/journalVoucher/create')); ?><br/><br/></li>
						<?php endif; ?>
						<?php if (TaxConnectionChecking::isCurrentConnectionSecondary() && Yii::app()->user->checkAccess('ntAccountingCreate')): ?>
							<li><?php echo CHtml::link('Pengeluaran Kas N', array('/transaction/expense/create', 'nt'=>1)); ?><br/><br/></li>
							<li><?php echo CHtml::link('Penerimaan Kas N', array('/transaction/deposit/create', 'nt'=>1)); ?><br/><br/></li>
							<li><?php echo CHtml::link('Pengeluaran Bank N', array('/transaction/expense/create', 'bank' => 1, 'nt'=>1)); ?><br/><br/></li>
							<li><?php echo CHtml::link('Penerimaan Bank N', array('/transaction/deposit/create', 'bank' => 1, 'nt'=>1)); ?><br/><br/></li>
							<li><?php echo CHtml::link('Jurnal Penyesuaian N', array('/transaction/journalVoucher/create', 'nt'=>1)); ?><br/><br/></li>
						<?php endif; ?>
					 </ul>
        </fieldset>
</div>
