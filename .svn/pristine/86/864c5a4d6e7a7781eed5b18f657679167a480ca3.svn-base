<?php if ($error === true && count($adjustment->details) === 0): ?>
	<p style="color: red">Form tidak ada data untuk insert database. Minimal satu data detail untuk melakukan penyimpanan.</p>
<?php endif; ?>
        
<table style="border: 1px solid">
	<tr style="background-color: skyblue">
		<th style="text-align: center">Nama Produk</th>
		<th style="text-align: center">Ukuran</th>
		<th style="text-align: center">Sekarang</th>
		<th style="text-align: center">Penyesuaian</th>
		<th style="text-align: center">Perbedaan</th>
		<th style="text-align: center">Satuan</th>
		<th style="text-align: center"></th>
	</tr>
	<?php foreach ($adjustment->details as $i=>$detail): ?>
        <tr style="background-color: azure">
			<td>
				<?php echo CHtml::activeHiddenField($detail, "[$i]product_id"); ?>
				<?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?>
			</td>
			<td style="text-align: center; width: 10%">
				<?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?>
			</td>
			<td style="text-align: center; width: 10%">
				<?php echo CHtml::activeHiddenField($detail, "[$i]quantity_current"); ?>
				<?php echo CHtml::encode(CHtml::value($detail, 'quantity_current')); ?>
			</td>
			<td style="text-align: center; width: 10%">
				<?php echo CHtml::activeTextField($detail, "[$i]quantity_adjustment", array('size'=>7, 'maxLength'=>20,
					'onchange'=>'$("#quantity_difference_'.$i.'").html(parseFloat($("#'.CHtml::activeId($detail, "[$i]quantity_adjustment").'").val() - $("#'.CHtml::activeId($detail, "[$i]quantity_current").'").val()).toFixed(0))'
				)); ?>
				<?php echo CHtml::error($detail, 'quantity_adjustment'); ?>
			</td>
			<td style="text-align: center; width: 10%">
				<span id="quantity_difference_<?php echo $i; ?>"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity_adjustment') - CHtml::value($detail, 'quantity_current'))); ?></span>
			</td>
			<td style="text-align: center; width: 10%">
				<?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?>
			</td>
			<td style="width: 5%">
				<?php echo CHtml::button('Delete', array(
					'onclick'=>CHtml::ajax(array(
						'type'=>'POST',
						'url'=>CController::createUrl('removeProductAjax', array('index'=>$i)),
						'update'=>'#detail_div',
					)),
				)); ?>
			</td>
        </tr>
	<?php endforeach; ?>
</table>
