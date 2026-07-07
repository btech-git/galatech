<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-brand-type-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_brand_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'category_brand_id', CHtml::listData(CategoryBrand::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'category_brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'type_id', CHtml::listData(Type::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'type_id'); ?>
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