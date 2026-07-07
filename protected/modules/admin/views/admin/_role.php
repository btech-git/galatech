<table>
	<tr>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][administrator]", CHtml::resolveValue($model, "roles[administrator]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'administrator')); ?>
			<?php echo CHtml::label('Administrator', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][master]", CHtml::resolveValue($model, "roles[master]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'master')); ?>
			<?php echo CHtml::label('Master', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][tax]", CHtml::resolveValue($model, "roles[tax]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'tax')); ?>
			<?php echo CHtml::label('All Tax Transaction', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][taxSecondary]", CHtml::resolveValue($model, "roles[taxSecondary]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'taxSecondary')); ?>
			<?php echo CHtml::label('All Secondary Tax Transaction', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
		<td>
			<?php echo CHtml::checkBox("Admin[roles][nonTax]", CHtml::resolveValue($model, "roles[nonTax]"), array('id'=>'Admin_roles_' . $counter, 'value'=>'nonTax')); ?>
			<?php echo CHtml::label('All Non Tax Transaction', 'Admin_roles_' . $counter++, array('style'=>'display: inline')); ?>
		</td>
	</tr>
</table>

<table>
	<tr>
		<th style="text-align: center; width: 50%">Tax Transaction</th>
		<th style="text-align: center">Create</th>
		<th style="text-align: center">Report</th>
		<th style="text-align: center">Edit</th>
	</tr>
	<tr>
		<td>Purchase</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchaseCreate]", CHtml::resolveValue($model, "roles[tPurchaseCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchaseCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchaseReport]", CHtml::resolveValue($model, "roles[tPurchaseReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchaseReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchaseEdit]", CHtml::resolveValue($model, "roles[tPurchaseEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchaseEdit')); ?></td>
	</tr>
	<tr>
		<td>Receive</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tReceiveCreate]", CHtml::resolveValue($model, "roles[tReceiveCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tReceiveCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tReceiveReport]", CHtml::resolveValue($model, "roles[tReceiveReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tReceiveReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tReceiveEdit]", CHtml::resolveValue($model, "roles[tReceiveEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tReceiveEdit')); ?></td>
	</tr>
	<tr>
		<td>Purchase Return</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchaseReturnCreate]", CHtml::resolveValue($model, "roles[tPurchaseReturnCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchaseReturnCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchaseReturnReport]", CHtml::resolveValue($model, "roles[tPurchaseReturnReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchaseReturnReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchaseReturnEdit]", CHtml::resolveValue($model, "roles[tPurchaseReturnEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchaseReturnEdit')); ?></td>
	</tr>
	<tr>
		<td>Purchase Payment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchasePaymentCreate]", CHtml::resolveValue($model, "roles[tPurchasePaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchasePaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchasePaymentReport]", CHtml::resolveValue($model, "roles[tPurchasePaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchasePaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tPurchasePaymentEdit]", CHtml::resolveValue($model, "roles[tPurchasePaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tPurchasePaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Downpayment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesDownpaymentCreate]", CHtml::resolveValue($model, "roles[tSalesDownpaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesDownpaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesDownpaymentReport]", CHtml::resolveValue($model, "roles[tSalesDownpaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesDownpaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesDownpaymentEdit]", CHtml::resolveValue($model, "roles[tSalesDownpaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesDownpaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Delivery</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tDeliveryCreate]", CHtml::resolveValue($model, "roles[tDeliveryCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tDeliveryCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tDeliveryReport]", CHtml::resolveValue($model, "roles[tDeliveryReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tDeliveryReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tDeliveryEdit]", CHtml::resolveValue($model, "roles[tDeliveryEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tDeliveryEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tInvoiceCreate]", CHtml::resolveValue($model, "roles[tInvoiceCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tInvoiceCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tInvoiceReport]", CHtml::resolveValue($model, "roles[tInvoiceReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tInvoiceReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tInvoiceEdit]", CHtml::resolveValue($model, "roles[tInvoiceEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tInvoiceEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Return</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesReturnCreate]", CHtml::resolveValue($model, "roles[tSalesReturnCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesReturnCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesReturnReport]", CHtml::resolveValue($model, "roles[tSalesReturnReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesReturnReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesReturnEdit]", CHtml::resolveValue($model, "roles[tSalesReturnEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesReturnEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Payment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesPaymentCreate]", CHtml::resolveValue($model, "roles[tSalesPaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesPaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesPaymentReport]", CHtml::resolveValue($model, "roles[tSalesPaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesPaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tSalesPaymentEdit]", CHtml::resolveValue($model, "roles[tSalesPaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tSalesPaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Accounting</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tAccountingCreate]", CHtml::resolveValue($model, "roles[tAccountingCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tAccountingCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tAccountingReport]", CHtml::resolveValue($model, "roles[tAccountingReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tAccountingReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tAccountingEdit]", CHtml::resolveValue($model, "roles[tAccountingEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tAccountingEdit')); ?></td>
	</tr>
	<tr>
		<td>Warehouse</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tWarehouseCreate]", CHtml::resolveValue($model, "roles[tWarehouseCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tWarehouseCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tWarehouseReport]", CHtml::resolveValue($model, "roles[tWarehouseReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tWarehouseReport')); ?></td>
		<td style="text-align: center"></td>
	</tr>
</table>

<table>
	<tr>
		<th style="text-align: center; width: 50%">Secondary Tax Transaction</th>
		<th style="text-align: center">Create</th>
		<th style="text-align: center">Report</th>
		<th style="text-align: center">Edit</th>
	</tr>
	<tr>
		<td>Purchase</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchaseCreate]", CHtml::resolveValue($model, "roles[tsPurchaseCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchaseCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchaseReport]", CHtml::resolveValue($model, "roles[tsPurchaseReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchaseReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchaseEdit]", CHtml::resolveValue($model, "roles[tsPurchaseEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchaseEdit')); ?></td>
	</tr>
	<tr>
		<td>Receive</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsReceiveCreate]", CHtml::resolveValue($model, "roles[tsReceiveCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsReceiveCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsReceiveReport]", CHtml::resolveValue($model, "roles[tsReceiveReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsReceiveReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsReceiveEdit]", CHtml::resolveValue($model, "roles[tsReceiveEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsReceiveEdit')); ?></td>
	</tr>
	<tr>
		<td>Purchase Return</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchaseReturnCreate]", CHtml::resolveValue($model, "roles[tsPurchaseReturnCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchaseReturnCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchaseReturnReport]", CHtml::resolveValue($model, "roles[tsPurchaseReturnReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchaseReturnReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchaseReturnEdit]", CHtml::resolveValue($model, "roles[tsPurchaseReturnEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchaseReturnEdit')); ?></td>
	</tr>
	<tr>
		<td>Purchase Payment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchasePaymentCreate]", CHtml::resolveValue($model, "roles[tsPurchasePaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchasePaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchasePaymentReport]", CHtml::resolveValue($model, "roles[tsPurchasePaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchasePaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsPurchasePaymentEdit]", CHtml::resolveValue($model, "roles[tsPurchasePaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsPurchasePaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Downpayment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesDownpaymentCreate]", CHtml::resolveValue($model, "roles[tsSalesDownpaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesDownpaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesDownpaymentReport]", CHtml::resolveValue($model, "roles[tsSalesDownpaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesDownpaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesDownpaymentEdit]", CHtml::resolveValue($model, "roles[tsSalesDownpaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesDownpaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Delivery</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsDeliveryCreate]", CHtml::resolveValue($model, "roles[tsDeliveryCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsDeliveryCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsDeliveryReport]", CHtml::resolveValue($model, "roles[tsDeliveryReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsDeliveryReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsDeliveryEdit]", CHtml::resolveValue($model, "roles[tsDeliveryEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsDeliveryEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsInvoiceCreate]", CHtml::resolveValue($model, "roles[tsInvoiceCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsInvoiceCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsInvoiceReport]", CHtml::resolveValue($model, "roles[tsInvoiceReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsInvoiceReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsInvoiceEdit]", CHtml::resolveValue($model, "roles[tsInvoiceEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsInvoiceEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Return</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesReturnCreate]", CHtml::resolveValue($model, "roles[tsSalesReturnCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesReturnCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesReturnReport]", CHtml::resolveValue($model, "roles[tsSalesReturnReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesReturnReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesReturnEdit]", CHtml::resolveValue($model, "roles[tsSalesReturnEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesReturnEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Payment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesPaymentCreate]", CHtml::resolveValue($model, "roles[tsSalesPaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesPaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesPaymentReport]", CHtml::resolveValue($model, "roles[tsSalesPaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesPaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsSalesPaymentEdit]", CHtml::resolveValue($model, "roles[tsSalesPaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsSalesPaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Accounting</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsAccountingCreate]", CHtml::resolveValue($model, "roles[tsAccountingCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsAccountingCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsAccountingReport]", CHtml::resolveValue($model, "roles[tsAccountingReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsAccountingReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsAccountingEdit]", CHtml::resolveValue($model, "roles[tsAccountingEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsAccountingEdit')); ?></td>
	</tr>
	<tr>
		<td>Warehouse</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsWarehouseCreate]", CHtml::resolveValue($model, "roles[tsWarehouseCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsWarehouseCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsWarehouseReport]", CHtml::resolveValue($model, "roles[tsWarehouseReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsWarehouseReport')); ?></td>
		<td style="text-align: center"></td>
	</tr>
</table>

<table>
	<tr>
		<th style="text-align: center; width: 50%">Non Tax Transaction</th>
		<th style="text-align: center">Create</th>
		<th style="text-align: center">Report</th>
		<th style="text-align: center">Edit</th>
	</tr>
	<tr>
		<td>Purchase</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchaseCreate]", CHtml::resolveValue($model, "roles[ntPurchaseCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchaseCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchaseReport]", CHtml::resolveValue($model, "roles[ntPurchaseReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchaseReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchaseEdit]", CHtml::resolveValue($model, "roles[ntPurchaseEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchaseEdit')); ?></td>
	</tr>
	<tr>
		<td>Receive</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntReceiveCreate]", CHtml::resolveValue($model, "roles[ntReceiveCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntReceiveCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntReceiveReport]", CHtml::resolveValue($model, "roles[ntReceiveReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntReceiveReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntReceiveEdit]", CHtml::resolveValue($model, "roles[ntReceiveEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntReceiveEdit')); ?></td>
	</tr>
	<tr>
		<td>Purchase Return</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchaseReturnCreate]", CHtml::resolveValue($model, "roles[ntPurchaseReturnCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchaseReturnCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchaseReturnReport]", CHtml::resolveValue($model, "roles[ntPurchaseReturnReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchaseReturnReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchaseReturnEdit]", CHtml::resolveValue($model, "roles[ntPurchaseReturnEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchaseReturnEdit')); ?></td>
	</tr>
	<tr>
		<td>Purchase Payment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchasePaymentCreate]", CHtml::resolveValue($model, "roles[ntPurchasePaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchasePaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchasePaymentReport]", CHtml::resolveValue($model, "roles[ntPurchasePaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchasePaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntPurchasePaymentEdit]", CHtml::resolveValue($model, "roles[ntPurchasePaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntPurchasePaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Downpayment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesDownpaymentCreate]", CHtml::resolveValue($model, "roles[ntSalesDownpaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesDownpaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesDownpaymentReport]", CHtml::resolveValue($model, "roles[ntSalesDownpaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesDownpaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesDownpaymentEdit]", CHtml::resolveValue($model, "roles[ntSalesDownpaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesDownpaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Delivery</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntDeliveryCreate]", CHtml::resolveValue($model, "roles[ntDeliveryCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntDeliveryCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntDeliveryReport]", CHtml::resolveValue($model, "roles[ntDeliveryReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntDeliveryReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntDeliveryEdit]", CHtml::resolveValue($model, "roles[ntDeliveryEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntDeliveryEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntInvoiceCreate]", CHtml::resolveValue($model, "roles[ntInvoiceCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntInvoiceCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntInvoiceReport]", CHtml::resolveValue($model, "roles[ntInvoiceReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntInvoiceReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntInvoiceEdit]", CHtml::resolveValue($model, "roles[ntInvoiceEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntInvoiceEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Return</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesReturnCreate]", CHtml::resolveValue($model, "roles[ntSalesReturnCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesReturnCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesReturnReport]", CHtml::resolveValue($model, "roles[ntSalesReturnReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesReturnReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesReturnEdit]", CHtml::resolveValue($model, "roles[ntSalesReturnEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesReturnEdit')); ?></td>
	</tr>
	<tr>
		<td>Sales Payment</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesPaymentCreate]", CHtml::resolveValue($model, "roles[ntSalesPaymentCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesPaymentCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesPaymentReport]", CHtml::resolveValue($model, "roles[ntSalesPaymentReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesPaymentReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntSalesPaymentEdit]", CHtml::resolveValue($model, "roles[ntSalesPaymentEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntSalesPaymentEdit')); ?></td>
	</tr>
	<tr>
		<td>Accounting</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntAccountingCreate]", CHtml::resolveValue($model, "roles[ntAccountingCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntAccountingCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntAccountingReport]", CHtml::resolveValue($model, "roles[ntAccountingReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntAccountingReport')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntAccountingEdit]", CHtml::resolveValue($model, "roles[ntAccountingEdit]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntAccountingEdit')); ?></td>
	</tr>
	<tr>
		<td>Warehouse</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntWarehouseCreate]", CHtml::resolveValue($model, "roles[ntWarehouseCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntWarehouseCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntWarehouseReport]", CHtml::resolveValue($model, "roles[ntWarehouseReport]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntWarehouseReport')); ?></td>
		<td style="text-align: center"></td>
	</tr>
</table>

<table>
	<tr>
		<th style="text-align: center; width: 50%">Dadap</th>
		<th style="text-align: center">Primary</th>
		<th style="text-align: center">Secondary Tax</th>
		<th style="text-align: center">Secondary Non-Tax</th>
	</tr>
	<tr>
		<td>Stock Transfer</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tTransferCreate]", CHtml::resolveValue($model, "roles[tTransferCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tTransferCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsTransferCreate]", CHtml::resolveValue($model, "roles[tsTransferCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsTransferCreate')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntTransferCreate]", CHtml::resolveValue($model, "roles[ntTransferCreate]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntTransferCreate')); ?></td>
	</tr>
	<tr>
		<td>Pengiriman Surat Jalan</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tDeliveryView]", CHtml::resolveValue($model, "roles[tDeliveryView]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tDeliveryView')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsDeliveryView]", CHtml::resolveValue($model, "roles[tsDeliveryView]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsDeliveryView')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntDeliveryView]", CHtml::resolveValue($model, "roles[ntDeliveryView]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntDeliveryView')); ?></td>
	</tr>
	<tr>
		<td>Transfer Print</td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tTransferPrint]", CHtml::resolveValue($model, "roles[tTransferPrint]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tTransferPrint')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][tsTransferPrint]", CHtml::resolveValue($model, "roles[tsTransferPrint]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'tsTransferPrint')); ?></td>
		<td style="text-align: center"><?php echo CHtml::checkBox("Admin[roles][ntTransferPrint]", CHtml::resolveValue($model, "roles[ntTransferPrint]"), array('id'=>'Admin_roles_' . $counter++, 'value'=>'ntTransferPrint')); ?></td>
	</tr>
</table>