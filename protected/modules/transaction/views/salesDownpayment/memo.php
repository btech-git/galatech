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

    .hcolumn1header { width: 55% }
    .hcolumn1value { width: 45% }
    .hcolumn2header { width: 55% }
    .hcolumn2value { width: 45% }

    .sig1 { width: 50% }
    .sig2 { width: 50% }
');
?>

<div id="memoheader">
    <div style="font-size: larger"><?php echo $salesDownpaymentHeaderText; ?></div>
    <div style="font-size: larger">INVOICE</div>
</div>

<br />

<div class="memonote">
    <div class="divtable">
        <div class="divtablecell hcolumn1">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Invoice #</div>
                    <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($salesDownpayment, 'number')); ?></div>
                </div>
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                    <div class="divtablecell info hcolumn1value">
                        <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($salesDownpayment, 'date')))); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="divtablecell hcolumn2">
            <div class="divtable">
                <div class="divtablerow">
                    <div class="divtablecell info hcolumn1header" style="font-weight: bold">Customer</div>
                    <div class="divtablecell info hcolumn1value"><?php echo $salesDownpaymentCustomer; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br />

<table class="memo">
    <tr id="theader">
        <th>Keterangan</th>
        <th>Banyak</th>
        <th>Jumlah</th>
    </tr>
    <tr class="titems">
        <td><?php echo nl2br(CHtml::encode(CHtml::value($salesDownpayment, 'note'))); ?></td>
        <td style="text-align: right; width: 20%">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($salesDownpayment, 'quantity'))); ?>
        </td>
        <td style="text-align: right; width: 20%">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($salesDownpayment, 'amount'))); ?>
        </td>
    </tr>
    <?php for ($j = 20, $i = 1 % $j + 1; $j > $i; $j--): ?>
        <tr class="titems">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    <?php endfor; ?>
    <tr>
        <td style="border-top: 2px solid"></td>
        <td style="border-top: 2px solid; font-weight: bold; text-align: right; font-size:12px">Uang Muka</td>
        <td style="border-top: 2px solid; font-weight: bold; text-align: right">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', CHtml::value($salesDownpayment, 'amount'))); ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: right; font-weight: bold; font-size:12px">
            PPN <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($salesDownpayment, 'tax')))); ?>%
        </td>
        <td style="text-align: right; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (CHtml::value($salesDownpayment, 'calculatedTax')))); ?>
        </td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: right; font-weight: bold; font-size:12px">Ongkos Kirim</td>
        <td style="text-align: right; font-weight: bold"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', (0))); ?></td>
    </tr>
    <tr>
        <td></td>
        <td style="text-align: right; font-weight: bold; font-size:12px">Grand Total</td>
        <td style="text-align: right; font-weight: bold">
            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', floor(CHtml::value($salesDownpayment, 'grandTotal')))); ?>
        </td>
    </tr>
</table>

<div style="text-transform: capitalize">
    Terbilang:
    <?php echo CHtml::encode(NumberWord::numberName(floor(CHtml::value($salesDownpayment, 'grandTotal')))); ?>
    rupiah
</div>

<br />
<br />

<div class="memosig">
    <div class="divtable">
        <div class="divtablecell sig1">
            <div>Penerima,</div>
        </div>
        <div class="divtablecell sig2">
            <div>Hormat kami,</div>
        </div>
    </div>
</div>