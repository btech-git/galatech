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
    <div style="font-size: larger"><?php echo $receiveHeaderText; ?></div>
    <div style="font-size: larger">PENERIMAAN BARANG</div>
</div>

<br />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Penerimaan #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($receive, 'number')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($receive, 'date')))); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Gudang</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($receive, 'warehouse.name')); ?></div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Pembelian #</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($receive, 'purchaseHeader.number')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Faktur #</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($receive, 'reference')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Supplier</div>
                    <div class="divtablecell info hcolumn2value"><?php echo $receiveSupplier; ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn2header" style="font-weight: bold">Catatan</div>
                    <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($receive, 'note')); ?></div>
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
        <th>Jumlah Pesanan</th>
        <th>Jumlah Diterima</th>
        <th>Satuan</th>
    </tr>
    <?php foreach ($receive->receiveDetails as $i => $detail): ?>
        <tr class="titems">
            <td><?php echo CHtml::encode(CHtml::value($detail, 'product.name')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'product.size')); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($detail, 'quantityOrdered')))); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($detail, 'quantity')))); ?></td>
            <td style="text-align: center"><?php echo CHtml::encode(CHtml::value($detail, 'product.unit.name')); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php for ($j = 5, $i = $i % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr class="titems">
        <td style="border-top:2px solid;">&nbsp;</td>
        <td style="border-top:2px solid;">&nbsp;</td>
        <td style="border-top:2px solid;text-align: right;">Total</td>
        <td style="border-top:2px solid;text-align: center;"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($receive, 'subTotalQuantity')))); ?></td>
        <td style="border-top:2px solid;">&nbsp;</td>
    </tr>
</table>

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