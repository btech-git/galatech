<?php 
Yii::app()->clientScript->registerScript('report', '
    $("#header").addClass("hide");
    $("#mainmenu").addClass("hide");
    $(".breadcrumbs").addClass("hide");
    $("#footer").addClass("hide");

    $("#EndDate").val("'.$endDate.'");
');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/transaction/report.css'); 
?>

<div class="hide">
    <div class="form" style="text-align: center">

    <?php echo CHtml::beginForm(array(''), 'get'); ?>

        <div class="row">
            Periode Sampai
            <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'EndDate',
                'options' => array(
                    'dateFormat' => 'yy-mm-dd',
                    'changeMonth'=>true,
                    'changeYear'=>true,
                ),
                'htmlOptions' => array(
                    'readonly' => true,
                    'placeholder' => 'Periode',
                ),
            )); ?>
        </div>

        <div class="row button">
            <?php echo CHtml::submitButton('Show'); ?>
            <?php echo CHtml::resetButton('Clear'); ?>
        </div>

    <?php echo CHtml::endForm(); ?>

    </div>

    <hr />
</div>

<div style="font-weight: bold; text-align: center">
    <div style="font-size: larger">PT. GALATECH JAYA ABADI</div>
    <div style="font-size: larger">BALANCE SHEET</div>
    <div>Periode : <?php echo CHtml::encode(Yii::app()->dateFormatter->format('d MMMM yyyy', strtotime($endDate))); ?></div>
</div>

<br />

<table style="width: 60%; margin: 0 auto; border-spacing: 0pt">
    <?php foreach ($accountCategoryTypes as $accountCategoryType): ?>
        <?php $accountTypeTotal = 0; ?>
        <tr>
            <td style="font-size: larger; font-weight: bold; text-transform: uppercase">
                <?php echo CHtml::encode(CHtml::value($accountCategoryType, 'name')); ?>
            </td>
            <td></td>
        </tr>
        <?php foreach ($accountCategoryType->accountCategories as $accountCategory): ?>
            <?php $accountCategoryTotal = 0; ?>
            <tr>
                <td style="padding-left: 25px; font-weight: bold; text-transform: capitalize">
                    <?php echo CHtml::encode(CHtml::value($accountCategory, 'name')); ?>
                </td>
                <td></td>
            </tr>
            <?php $accounts = Account::model()->findAllByAttributes(array('account_category_id' => $accountCategory->id, 'is_inactive' => 0)); ?>
            <?php foreach ($accounts as $account): ?>
                <?php $balance = $account->getBalanceTotal($endDate); ?>
                <?php if ($balance > 0 || $balance < 0): ?>
                    <tr>
                        <td style="padding-left: 50px"><?php echo CHtml::encode(CHtml::value($account, 'name')); ?></td>
                        <td style="text-align: right">
                            <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $balance)); ?>
                        </td>
                    </tr>
                    <?php $accountCategoryTotal += $balance; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
                <td style="text-align: right; font-weight: bold">TOTAL</td>
                <td style="text-align: right; font-weight: bold; border-top: 1px solid">
                    <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $accountCategoryTotal)); ?>
                </td>
            </tr>
            <?php $accountTypeTotal += $accountCategoryTotal; ?>
        <?php endforeach; ?>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: right; font-weight: bold; border-top: 1px solid; text-transform: uppercase">
                TOTAL <?php echo CHtml::encode(CHtml::value($accountCategoryType, 'name')); ?>
            </td>
            <td style="text-align: right; font-weight: bold; border-top: 1px solid">
                <?php echo CHtml::encode(Yii::app()->numberFormatter->format('#,##0', $accountTypeTotal)); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>