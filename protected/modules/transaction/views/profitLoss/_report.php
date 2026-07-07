<table style="margin: 0 auto; width: 70%; font-size: larger">
	<tr>
		<td>PENJUALAN</td>
		<td></td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['sale_amount']); ?></td>
	</tr>
	<tr>
		<td style="text-align: center">Stok Awal</td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['beginning_stock_amount']); ?></td>
		<td></td>
	</tr>
	<tr>
		<td style="text-align: center">Pembelian</td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['purchase_amount']); ?></td>
		<td></td>
	</tr>
	<tr>
		<td style="text-align: center; border-top: 1px solid">Barang Siap Jual</td>
		<td style="text-align: right; border-top: 1px solid"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['ready_stock']); ?></td>
		<td></td>
	</tr>
	<tr>
		<td style="text-align: center">Stok Akhir</td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['ending_stock_amount']); ?></td>
		<td></td>
	</tr>
	<tr>
		<td>HPP</td>
		<td style="border-top: 1px solid"></td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['cogs']); ?></td>
	</tr>
	<tr>
		<td style="font-weight: bold; border-top: 1px solid">LABA KOTOR</td>
		<td style="border-top: 1px solid"></td>
		<td style="font-weight: bold; border-top: 1px solid; text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['gross']); ?></td>
	</tr>
	<tr>
		<td>BEBAN</td>
		<td></td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['expense_amount']); ?></td>
	</tr>
	<tr>
		<td>BEBAN LAIN-LAIN</td>
		<td></td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['other_expense_amount']); ?></td>
	</tr>
	<tr>
		<td>PENDAPATAN LAIN-LAIN</td>
		<td></td>
		<td style="text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['other_income_amount']); ?></td>
	</tr>
	<tr>
		<td style="font-weight: bold; border-top: 1px solid">LABA / RUGI</td>
		<td style="border-top: 1px solid"></td>
		<td style="font-weight: bold; border-top: 1px solid; text-align: right"><?php echo Yii::app()->numberFormatter->format('#,##0.00', $row['profit_loss']); ?></td>
	</tr>
</table>