<?php
/**
 * @var $supplier as Supplier model
 * @var $supplierDataProvider
 * @var $customer as Customer model
 * @var $customerDataProvider
 */
?>

<?php echo CHtml::beginForm(); ?>
<?php echo CHtml::hiddenField('SupplierId'); ?>
<?php echo CHtml::hiddenField('CustomerId'); ?>

<?php echo CHtml::endForm(); ?>
<br />

<div style="font-size:16px; text-align:center">
    <h2>Supplier</h2>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'supplier-grid',
        'dataProvider' => $supplierDataProvider,
        'filter' => $supplier,
        'columns' => array(
            'company',
            'name',
            'phone',
            'email',
            array(
                'name' => 'is_inactive',
                'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
                'value' => '$data->status()',
            ),
        ),
        'selectionChanged' => '
            function(id){
                $("#SupplierId").val($.fn.yiiGridView.getSelection(id));

                if ($.fn.yiiGridView.getSelection(id) == "") {
                        $("#model-dialog").dialog("open");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "' . CController::createUrl('ajaxHtmlSelectView', array('type' => 1)) . '",
                        data: $("form").serialize(),
                        success: function(html){
                            $("#detail_div").html(html);
                            $("#model-dialog").dialog("open");
                        }
                    });
                }
            }
        ',
    )); ?>
    <br />

    <h2>Customer</h2>
    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'customer-grid',
        'dataProvider' => $customerDataProvider,
        'filter' => $customer,
        'columns' => array(
            'company',
            'name',
            'npwp',
            'phone',
            'email',
            array(
                'name' => 'is_inactive',
                'filter' => array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive'),
                'value' => '$data->status()',
            ),
        ),
        'selectionChanged' => '
            function(id){
                $("#CustomerId").val($.fn.yiiGridView.getSelection(id));

                if ($.fn.yiiGridView.getSelection(id) == "") {
                    $("#model-dialog").dialog("open");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "' . CController::createUrl('ajaxHtmlSelectView', array('type' => 2)) . '",
                        data: $("form").serialize(),
                        success: function(html){
                            $("#detail_div").html(html);
                            $("#model-dialog").dialog("open");
                        }
                    });
                }
            }
        ',
    )); ?>

    <br />
    
    <div>
        <table style="border: 1px solid">
            <tr>
                <td style="font-weight: bold; text-align: center; border: 1px solid">Total Hutang</td>
                <td style="font-weight: bold; text-align: center; border: 1px solid">Total Piutang</td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: center; border: 1px solid">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $totalReceivables)); ?>
                </td>
                
                <td style="font-weight: bold; text-align: center; border: 1px solid">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $totalPayables)); ?>
                </td>
            </tr>
        </table>
    </div>
</div>