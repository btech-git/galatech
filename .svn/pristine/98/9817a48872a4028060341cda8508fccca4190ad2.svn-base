<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-material-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'category_id', CHtml::listData(Category::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'category_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'material_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'material_id', CHtml::listData(Material::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'material_id'); ?>
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