<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-material-grade-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_material_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'category_material_id', CHtml::listData(CategoryMaterial::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'category_material_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'grade_id', CHtml::listData(Grade::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'grade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_inactive'); ?>
		<?php echo $form->dropDownList($model,'is_inactive', array(ActiveRecord::ACTIVE => 'Active', ActiveRecord::INACTIVE => 'Inactive')); ?>
		<?php echo $form->error($model,'is_inactive'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->