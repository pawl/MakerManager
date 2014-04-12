<?php
/* @var $this TrainingToolsController */
/* @var $model TrainingTools */
/* @var $form CActiveForm */
?>

<div class="form span12">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'training-tools-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p style="margin-left: -30px;">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'tool_mac_address'); ?>
		<?php echo $form->textField($model,'tool_mac_address',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'tool_mac_address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tool_name'); ?>
		<?php echo $form->textField($model,'tool_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'tool_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timeout'); ?>
		<?php echo $form->textField($model,'timeout'); ?>
		<?php echo $form->error($model,'timeout'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'combination_lock_code'); ?>
		<?php echo $form->textField($model,'combination_lock_code',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'combination_lock_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'combination_lock_code_length'); ?>
		<?php echo $form->textField($model,'combination_lock_code_length'); ?>
		<?php echo $form->error($model,'combination_lock_code_length'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->