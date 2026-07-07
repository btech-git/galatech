<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-classification-variety-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category_classification_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'category_classification_id', CHtml::listData(CategoryClassification::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'category_classification_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'variety_id'); ?>
		<?php echo CHtml::activeDropDownList($model, 'variety_id', CHtml::listData(Variety::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'variety_id'); ?>
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