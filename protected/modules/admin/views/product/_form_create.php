<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
        'action'=>$action,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model->header); ?>

        <div class="row">
                <?php echo $form->label($model->header,'Kategori'); ?>
                <?php if ($model->header->isNewRecord): ?>
                        <?php echo $form->dropDownList($model->header,'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name'), array('empty'=>'-- Select Category --',
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'url'=>CController::createUrl('selectSpecificationAjax', array('view'=>'_form_create', 'action'=>$action)),
                                        'success'=>'function(html) {
                                                $("#form_div").html(html);
                                                '.CHtml::ajax(array(
                                                        'type'=>'POST',
                                                        'dataType'=>'JSON',
                                                        'data'=>'js:$("form").serialize()',
                                                        'url'=>CController::createUrl('categorySelectionAjaxData', array('emptyText'=>'Not Available')),
                                                        'success'=>'function(data) {
                                                                $("#'.CHtml::activeId($model->header, 'brand_id').'").html(data.brandOptions);
                                                                $("#'.CHtml::activeId($model->header, 'classification_id').'").html(data.classificationOptions);
                                                                $("#'.CHtml::activeId($model->header, 'connection_id').'").html(data.connectionOptions);
                                                                $("#'.CHtml::activeId($model->header, 'material_id').'").html(data.materialOptions);
                                                                $("#'.CHtml::activeId($model->header, 'thickness_id').'").html(data.thicknessOptions);
                                                                $("#'.CHtml::activeId($model->header, 'type_id').'").html(data.typeOptions);
                                                                $("#'.CHtml::activeId($model->header, 'variety_id').'").html(data.varietyOptions);
                                                        }',
                                                )).'
                                        }',
                                )),
                        )); ?>
                        <?php echo $form->error($model->header,'category_id'); ?>
                <?php else: ?>
                        <?php echo $form->hiddenField($model->header,'category_id'); ?>
                        <?php echo CHtml::encode(CHtml::value($model->header,'category.name')); ?>
                <?php endif; ?>
        </div>

	<div class="row">
		<?php echo $form->label($model->header, 'Nama'); ?>
		<?php echo $form->textField($model->header,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model->header,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model->header,'Satuan'); ?>
                <?php echo $form->dropDownList($model->header,'unit_id', CHtml::listData(Unit::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model->header,'unit_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model->header,'COGS Average'); ?>
		<?php echo $form->textField($model->header,'weighted_purchase_price',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model->header,'weighted_purchase_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model->header,'Harga Jual'); ?>
		<?php echo $form->textField($model->header,'selling_price',array('size'=>18,'maxlength'=>18)); ?>
		<?php echo $form->error($model->header,'selling_price'); ?>
	</div>
        
        <div class="row">
		<?php echo CHtml::button('Add Size', array(
			'id' => 'size_button',
			'onclick'=>'
				$.ajax({
					type: "POST",
					url: "' . CController::createUrl('ajaxHtmlAddDetail', array('id' => $model->header->id)) . '",
					data: $("form").serialize(),
					success: function(html) { 
						$("#detail_div").html(html);
					}
				})
			'
		)); ?>
	</div>
        
        <div id="detail_div">
		<?php $this->renderPartial('_detail', array('model' => $model)); ?>
	</div>

<!--	<div class="row">
		<?php //echo $form->labelEx($model,'size'); ?>
		<?php //echo $form->textField($model,'size',array('size'=>60,'maxlength'=>60)); ?>
		<?php //echo $form->error($model,'size'); ?>
	</div>-->
        <?php if (in_array('length', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->labelEx($model->header,'length'); ?>
                        <?php echo $form->textField($model->header,'length',array('size'=>60,'maxlength'=>60)); ?>
                        <?php echo $form->error($model->header,'length'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('classification_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Class Tebal'); ?>
                        <?php echo $form->dropDownList($model->header,'classification_id', $listData['classification'], array('empty'=>'Not Available',
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'dataType'=>'JSON',
                                        'url'=>CController::createUrl('classificationSelectionAjaxData', array('emptyText'=>'Not Available')),
                                        'success'=>'function(data) {
                                                $("#'.CHtml::activeId($model->header, 'connection_id').'").html(data.connectionOptions);
                                                $("#'.CHtml::activeId($model->header, 'material_id').'").html(data.materialOptions);
                                                $("#'.CHtml::activeId($model->header, 'variety_id').'").html(data.varietyOptions);
                                        }',
                                )),
                        )); ?>
                        <?php echo $form->error($model->header,'classification_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('material_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Material'); ?>
                        <?php echo $form->dropDownList($model->header,'material_id', $listData['material'], array('empty'=>'Not Available',
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'dataType'=>'JSON',
                                        'url'=>CController::createUrl('materialSelectionAjaxData', array('emptyText'=>'Not Available')),
                                        'success'=>'function(data) {
                                                $("#'.CHtml::activeId($model->header, 'grade_id').'").html(data.gradeOptions);
                                        }',
                                )),
                        )); ?>
                        <?php echo $form->error($model->header,'material_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('grade_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Grade'); ?>
                        <?php echo $form->dropDownList($model->header,'grade_id', $listData['grade'], array('empty'=>'Not Available',
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'dataType'=>'JSON',
                                        'url'=>CController::createUrl('gradeSelectionAjaxData', array('emptyText'=>'Not Available')),
                                        'success'=>'function(data) {
                                                $("#'.CHtml::activeId($model->header, 'brand_id').'").html(data.brandOptions);
                                                $("#'.CHtml::activeId($model->header, 'thickness_id').'").html(data.thicknessOptions);
                                        }',
                                )),
                        )); ?>
                        <?php echo $form->error($model->header,'grade_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('brand_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Merk'); ?>
                        <?php echo $form->dropDownList($model->header,'brand_id', $listData['brand'], array('empty'=>'Not Available',
                                'onchange'=>CHtml::ajax(array(
                                        'type'=>'POST',
                                        'dataType'=>'JSON',
                                        'url'=>CController::createUrl('brandSelectionAjaxData', array('emptyText'=>'Not Available')),
                                        'success'=>'function(data) {
                                                $("#'.CHtml::activeId($model->header, 'body_type_id').'").html(data.bodyOptions);
                                                $("#'.CHtml::activeId($model->header, 'connection_id').'").html(data.connectionOptions);
                                                $("#'.CHtml::activeId($model->header, 'disc_material_id').'").html(data.discOptions);
                                                $("#'.CHtml::activeId($model->header, 'handling_id').'").html(data.handlingOptions);
                                                $("#'.CHtml::activeId($model->header, 'type_id').'").html(data.typeOptions);
                                        }',
                                )),
                        )); ?>
                        <?php echo $form->error($model->header,'brand_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('thickness_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Ketebalan'); ?>
                        <?php echo $form->dropDownList($model->header,'thickness_id', $listData['thickness'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'thickness_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('body_type_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Body'); ?>
                        <?php echo $form->dropDownList($model->header,'body_type_id', $listData['body'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'body_type_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('connection_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Connection'); ?>
                        <?php echo $form->dropDownList($model->header,'connection_id', $listData['connection'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'connection_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('disc_material_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Disc'); ?>
                        <?php echo $form->dropDownList($model->header,'disc_material_id', $listData['disc'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'disc_material_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('handling_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Handling'); ?>
                        <?php echo $form->dropDownList($model->header,'handling_id', $listData['handling'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'handling_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('type_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Tipe'); ?>
                        <?php echo $form->dropDownList($model->header,'type_id', $listData['type'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'type_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('variety_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Jenis'); ?>
                        <?php echo $form->dropDownList($model->header,'variety_id', $listData['variety'], array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'variety_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('drat', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Drat / ND'); ?>
                        <?php echo $form->dropDownList($model->header,'drat', array('1'=>'Drat', '2'=>'Non-Drat'), array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'drat'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('physical_thickness', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Tebal Fisik'); ?>
                        <?php echo $form->textField($model->header,'physical_thickness'); ?>
                        <?php echo $form->error($model->header,'physical_thickness'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('connection_material_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Connection'); ?>
                        <?php echo $form->dropDownList($model->header,'connection_material_id', CHtml::listData(ConnectionMaterial::model()->findAll(), 'id', 'name'), array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'connection_material_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('parameter_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Parameter'); ?>
                        <?php echo $form->dropDownList($model->header,'parameter_id', CHtml::listData(Parameter::model()->findAll(), 'id', 'name'), array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'parameter_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('range_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Range'); ?>
                        <?php echo $form->dropDownList($model->header,'range_id', CHtml::listData(Range::model()->findAll(), 'id', 'name'), array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'range_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('bellow_id', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Bellow'); ?>
                        <?php echo $form->dropDownList($model->header,'bellow_id', CHtml::listData(Bellow::model()->findAll(), 'id', 'name'), array('empty'=>'Not Available')); ?>
                        <?php echo $form->error($model->header,'bellow_id'); ?>
                </div>
        <?php endif; ?>

        <?php if (in_array('connection_diameter', $specificationList)): ?>
                <div class="row">
                        <?php echo $form->label($model->header,'Connection Diameter'); ?>
                        <?php echo $form->textField($model->header,'connection_diameter'); ?>
                        <?php echo $form->error($model->header,'connection_diameter'); ?>
                </div>
        <?php endif; ?>

	<div class="row">
		<?php echo $form->labelEx($model->header,'is_inactive'); ?>
		<?php echo $form->dropDownList($model->header,'is_inactive', array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
		<?php echo $form->error($model->header,'is_inactive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->header->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
