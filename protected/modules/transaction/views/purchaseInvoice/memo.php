<?php
Yii::app()->clientScript->registerScript('memo', '
        $("#header").addClass("hide");
        $("#mainmenu").addClass("hide");
        $(".breadcrumbs").addClass("hide");
        $("#footer").addClass("hide");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/transaction/memo.css');
Yii::app()->clientScript->registerCss('memo', '
        .hcolumn1 { width: 50% }
        .hcolumn2 { width: 50% }
        
        .hcolumn1header { width: 35% }
        .hcolumn1value { width: 65% }
        .hcolumn2header { width: 35% }
        .hcolumn2value { width: 65% }
        
        .sig1 { width: 25% }
        .sig2 { width: 25% }
        .sig3 { width: 25% }
        .sig4 { width: 25% }
');
?>

<div id="memoheader">
        <div style="font-size: larger"><?php echo $purchaseInvoiceHeaderText; ?></div>
        <div style="font-size: larger">Faktur Pembelian</div>
</div>

<br />

<div class="memonote">
        <div class="divtable">
                <div class="divtablecell hcolumn1">
                        <div class="divtable">
								<div class="divtablerow">
                                        <div class="divtablecell info hcolumn1header" style="font-weight: bold">Penerimaan Faktur #</div>
                                        <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($purchaseInvoice, 'number')); ?></div>
                                </div>
                                <div class="divtablerow">
                                        <div class="divtablecell info hcolumn1header" style="font-weight: bold">Tanggal</div>
                                        <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime(CHtml::value($purchaseInvoice, 'date')))); ?></div>
                                </div>
                                <div class="divtablerow">
                                        <div class="divtablecell info hcolumn1header" style="font-weight: bold">Pembelian #</div>
                                        <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($purchaseInvoice, 'purchaseHeader.number')); ?></div>
                                </div>
                        </div>
                </div>
                <div class="divtablecell hcolumn2">
                        <div class="divtable">
								<div class="divtablerow">
                                        <div class="divtablecell info hcolumn1header" style="font-weight: bold">Faktur #</div>
                                        <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(CHtml::value($purchaseInvoice, 'reference')); ?></div>
                                </div>
								<div class="divtablerow">
                                        <div class="divtablecell info hcolumn1header" style="font-weight: bold">Supplier</div>
                                        <div class="divtablecell info hcolumn1value"><?php echo $purchaseInvoiceSupplier; ?></div>
                                </div>
								<div class="divtablerow">
                                        <div class="divtablecell info hcolumn1header" style="font-weight: bold">Jumlah</div>
                                        <div class="divtablecell info hcolumn1value"><?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0.00', CHtml::value($purchaseInvoice, 'totalPurchase'))); ?></div>
                                </div>
                                <div class="divtablerow">
                                        <div class="divtablecell info hcolumn2header" style="font-weight: bold">Catatan</div>
                                        <div class="divtablecell info hcolumn2value"><?php echo CHtml::encode(CHtml::value($purchaseInvoice, 'note')); ?></div>
                                </div>
                        </div>
                </div>
        </div>
</div>

<br />

<div class="memosig">
        <div class="divtable">
                <div class="divtablecell sig1">
                        <div>Tanda Terima,</div>
                </div>
                <div class="divtablecell sig2">
                        <div>Disiapkan oleh,</div>
                </div>
                <div class="divtablecell sig3">
                        <div>Diperiksa oleh,</div>
                </div>
                <div class="divtablecell sig4">
                        <div>Hormat kami,</div>
                </div>
        </div>
</div>