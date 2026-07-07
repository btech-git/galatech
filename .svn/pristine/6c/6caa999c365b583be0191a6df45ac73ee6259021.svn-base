<?php
Yii::app()->clientScript->registerScript('memo', '
	$("#header").addClass("hide");
	$("#mainmenu").addClass("hide");
	$(".breadcrumbs").addClass("hide");
	$("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl . '/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
	.hcolumn1 { width: 50% }
	.hcolumn2 { width: 50% }

	.hcolumn1header { width: 35% }
	.hcolumn1value { width: 65% }
	.hcolumn2header { width: 35% }
	.hcolumn2value { width: 65% }
	.hcolumn3header { width: 35% }
	.hcolumn3value { width: 65% }

	.sig1 { width: 25% }
	.sig2 { width: 50% }
	.sig3 { width: 25% }
');
?>

<div id="memoheader">
    <div style="font-size: 1.5em"><?php echo $purchaseHeaderText; ?></div>
    <div style="font-size: larger">PURCHASE ORDER</div>
</div>

<br />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Pembelian #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($purchase, 'number')); ?></div>
                </div>
            </div>
        </div>
        
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn2value">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchase, 'date')))); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn3header" style="font-weight: bold">Supplier</div>
                    <div class="divtablecell info hcolumn3value"><?php echo $purchaseSupplier; ?></div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn3header" style="font-weight: bold">Pembuat</div>
                    <div class="divtablecell info hcolumn3value"><?php echo CHtml::encode(CHtml::value($purchase, 'admin.username')); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="memo">
    <tr id="theader">
        <th style="font-size:10px; width: 3%">No</th>
        <th style="font-size:10px">Nama Barang</th>
        <th style="font-size:10px">Ukuran</th>
        <th style="font-size:10px">Jumlah</th>
        <th style="font-size:10px">Satuan</th>
        <th style="font-size:10px">Harga Satuan</th>
    </tr>
    <?php foreach ($purchase->purchaseDetails as $i => $detail): ?>
        <tr class="titems">
            <td style="text-align: center; font-size:10px"><?php echo $i + 1; ?></td>
            <td style="font-size:12px"><?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?></td>
            <td style="text-align: center; font-size:14px"><?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?></td>
            <td style="text-align: center; font-size:14px">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($detail, 'quantity')))); ?>
            </td>
            <td style="text-align: center;"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
            <td style="text-align: right; font-size:14px">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', $detail->price_before_tax)); ?>
            </td>
        </tr>
        <?php $i++; ?>
    <?php endforeach; ?>
    <?php for ($j = 13, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr class="titems">
        <td style="border-top: 2px solid;text-align: right;" colspan="3">Total</td>
        <td style="border-top: 2px solid;text-align: center;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($purchase, 'subTotalQuantity'))); ?>
        </td>
        <td style="border-top: 2px solid;">&nbsp;</td>
        <td style="border-top: 2px solid;text-align: right;">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchase, 'grandTotal'))); ?>
        </td>
    </tr>
</table>

<div>
    CATATAN: <?php echo CHtml::encode(CHtml::value($purchase, 'note')); ?>
</div>

<div class="memosig">
    <div class="divtable">
        <div class="divtablecell sig1">
            &nbsp;
        </div>
        <div class="divtablecell sig2">
            &nbsp;
        </div>
        <div class="divtablecell sig3">
            <div>Hormat Kami,</div>
        </div>
    </div>
</div>