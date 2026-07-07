<h1>Jurnal Penyesuaian</h1>

<div class="form">

    <?php echo CHtml::beginForm(); ?>

    <div class="container">
        <div class="span-12">
<!--            <div class="row">
                <?php /*echo CHtml::label('Jurnal #', ''); ?>
                <?php echo CHtml::encode(CHtml::value($journal->header, 'number')); ?>
                <?php echo CHtml::error($journal->header, 'number');*/ ?>
            </div>-->

            <div class="row">
                <?php echo CHtml::label('Tanggal', ''); ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $journal->header,
                    'attribute' => 'date',
                    // additional javascript options for the date picker plugin
                    'options' => array(
                        'dateFormat' => 'yy-mm-dd',
                    ),
                    'htmlOptions' => array(
                        'readonly' => true,
                    ),
                ));
                ?>
                <?php echo CHtml::error($journal->header, 'date'); ?>
            </div>
        </div>

        <div class="span-12 last">
            <div class="row">
                <?php echo CHtml::label('Catatan', ''); ?>
                <?php echo CHtml::activeTextArea($journal->header, 'note', array('rows' => 5, 'cols' => 30)); ?>
                <?php echo CHtml::error($journal->header, 'note'); ?>
            </div>
        </div>
    </div>

    <hr />

    <div class="row">
        Cari Nama Akun :
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'name' => 'Account',
            'sourceUrl' => CController::createUrl('accountCompletion'),
            // additional javascript options for the autocomplete plugin
            'options' => array(
                'minLength' => '2',
                'select' => 'js:function(event, ui) {
                    $(this).val(ui.item.value);
                    ui.item.value = "";
                    $.ajax({
                            type: "POST",
                            url: "' . CController::createUrl('addAccountAjax') . '",
                            data: $(this).parents("form").serialize(),
                            success: function(html) { $("#detail_div").html(html); },
                    });
                }',
            ),
        ));
        ?>
    </div>

    <div id="detail_div">
        <?php $this->renderPartial('_detail', array('journal' => $journal, 'error' => $error)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit', array('name' => 'Submit', 'confirm' => 'Are you sure you want to save?')); ?>
    </div>
    <?php echo IdempotentManager::generate(); ?>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->