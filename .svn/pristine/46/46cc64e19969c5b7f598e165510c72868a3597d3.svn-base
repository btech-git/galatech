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
        
        .sig1 { width: 25% }
        .sig2 { width: 50% }
        .sig3 { width: 25% }
');
?>

<div id="memoheader">
    <div style="font-size: larger"><?php echo $salesReturnHeaderText; ?></div>
    <div style="font-size: larger">NOTA RETUR PENJUALAN</div>
</div>

<br />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Retur #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($salesReturn, 'number')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salesReturn, 'date')))); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Gudang</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($salesReturn, 'warehouse.name')); ?></div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Invoice #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($salesReturn, 'invoiceHeader.codeNumber')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Customer</div>
                    <div class="divtablecell info hcolumn2value"><?php echo $salesReturnCustomer; ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Catatan</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($salesReturn, 'note')); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br />

<table class="memo">
    <tr id="theader">
        <th>Nama Barang</th>
        <th>Ukuran</th>
<!--		<th>Jumlah Terjual</th>-->
        <th>Jumlah Retur</th>
        <th>Satuan</th>
        <th>Harga Satuan</th>
        <th>Total</th>
    </tr>
    <?php foreach ($salesReturn->salesReturnDetails as $i => $detail): ?>
        <tr class="titems">
            <td style="width:15%"><?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?></td>
            <td style="text-align: center; width:5%"><?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?></td>
    <!--				<td style="text-align: center"><?php //echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantitySold')));    ?></td>-->
            <td style="text-align: center; width:5%"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'quantity'))); ?></td>
            <td style="text-align: center; width:5%"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
            <td style="text-align: right; width:5%"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'unitPrice'))); ?></td>
            <td style="text-align: right; width:5%"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($detail, 'total'))); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php for ($j = 5, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td style="border-top: 2px solid"></td>
        <td style="border-top: 2px solid;font-weight:bold;text-align: right;">Total</td>
        <td style="border-top: 2px solid;text-align: center;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesReturn, 'subTotalQuantity')))); ?></td>
        <td style="border-top: 2px solid;font-weight:bold">Sub Total</td>
        <td style="border-top: 2px solid"></td>
        <td style="border-top: 2px solid; text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesReturn, 'subTotal')))); ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Tax &nbsp <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesReturn, 'tax')))); ?> %</td>
        <td></td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesReturn, 'calculatedTax')))); ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Ongkos Kirim</td>
        <td></td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesReturn, 'shipping_fee')))); ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="font-weight:bold">Grand Total</td>
        <td></td>
        <td style="text-align: right"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesReturn, 'grandTotal')))); ?></td>
    </tr>
</table>

<div style="text-transform: capitalize">
    Terbilang:
    <?php echo CHtml::encode(NumberWord::numberName(floor(CHtml::value($salesReturn, 'grandTotal')))); ?>
    rupiah
</div>

<br />

<div class="memosig">
    <div class="divtable">
        <div class="divtablecell sig1">
            <div>Penerima,</div>
        </div>
        <div class="divtablecell sig2">
            &nbsp;
        </div>
        <div class="divtablecell sig3">
            <div>Hormat Kami,</div>
        </div>
    </div>
</div>
