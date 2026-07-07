<h1>Pajak Revisi</h1>

<div class="form">

<?php echo CHtml::beginForm(); ?>
        
        <div class="container">
                <div class="span-12">
                        <div class="row">
                                <?php echo CHtml::label('Tax Revisi #', false); ?>
                                <?php echo CHtml::encode(CHtml::value($taxFormRevised->header, 'id')); ?>
                                <?php echo CHtml::error($taxFormRevised->header, 'id'); ?>
                        </div>

                        <div class="row">
                                <?php echo CHtml::label('Tanggal', false); ?>
                                <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'model'=>$taxFormRevised->header,
                                        'attribute'=>'date',
                                        // additional javascript options for the date picker plugin
                                        'options'=>array(
                                                'dateFormat'=>'yy-mm-dd',
                                        ),
                                        'htmlOptions'=>array(
                                                'readonly'=>true,
                                        ),
                                )); ?>
                                <?php echo CHtml::error($taxFormRevised->header, 'date'); ?>
                        </div>
                    
                </div>
        
                <div class="span-12 last">
                        <div class="row">
                                <?php echo CHtml::label('Faktur Pajak #', ''); ?>
                                <?php echo CHtml::activeTextField($taxFormRevised->header,'tax_form_id', array('readonly'=>true, 'onclick'=>'$("#taxform-dialog").dialog("open"); return false;', 'onkeypress'=>'if (event.keyCode == 13) { $("#taxform-dialog").dialog("open"); return false; }')); ?>
                                <?php echo CHtml::openTag('span', array('id'=>'tax_form_number')); ?>
                                <?php echo CHtml::encode(CHtml::value($taxFormRevised->header,'tax_form_id')); ?>
                                <?php echo CHtml::closeTag('span'); ?>
                                <?php echo CHtml::error($taxFormRevised->header,'tax_form_id'); ?>
                                
                                <?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                                        'id'=>'taxform-dialog',
                                        // additional javascript options for the dialog plugin
                                        'options'=>array(
                                                'title'=>'Faktur Pajak',
                                                'autoOpen'=>false,
                                                'width'=>'auto',
                                                'modal'=>true,
                                        ),
                                )); ?>
                                <?php $this->widget('zii.widgets.grid.CGridView', array(
                                        'id'=>'taxform-grid',
                                        'dataProvider'=>$taxForm->searchByTaxFormRevised(),
                                        'filter'=>$taxForm,
                                        'selectionChanged'=>'js:function(id) {
                                                $("#'.CHtml::activeId($taxFormRevised->header, 'tax_form_id').'").val($.fn.yiiGridView.getSelection(id));
                                                $("#taxform-header-dialog").dialog("close");
                                                if ($.fn.yiiGridView.getSelection(id) == "")
                                                {
                                                        $("#taxform_header_number").html("");
                                                }
                                                else
                                                {
                                                        $.ajax({
                                                                type: "POST",
                                                                dataType: "JSON",
                                                                url: "'.CController::createUrl('taxformAjaxData', array('id'=>$taxFormRevised->header->id)).'",
                                                                data: $("form").serialize(),
                                                                success: function(data) {
                                                                        $("#taxform_header_number").html(data.tax_form_id);
                                                                },
                                                        });
                                                }
                                                $.ajax({
                                                        type: "POST",
                                                        url: "'.CController::createUrl('addItemAjax', array('id'=>$taxFormRevised->header->id)).'",
                                                        data: $("form").serialize(),
                                                        success: function(html) { $("#detail_div").html(html); },
                                                });
                                        }',
                                        'columns'=>array(
                                                'number',
                                                'date',
                                                'tax_form_id',
                                        ),
                                )); ?>
                                <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
                        </div>
                        <div class="row">
                                <?php echo CHtml::label('Catatan', ''); ?>
                                <?php echo CHtml::activeTextArea($taxFormRevised->header, 'note', array('rows'=>5, 'cols'=>30)); ?>
                                <?php echo CHtml::error($taxFormRevised->header, 'note'); ?>
                        </div>
                </div>
        </div>
        
        <hr />

        <div id="detail_div">
                <?php $this->renderPartial('_detail', array('taxFormRevised'=>$taxFormRevised, 'error'=>$error)); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('name'=>'Submit', 'confirm'=>'Are you sure you want to save?')); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->
