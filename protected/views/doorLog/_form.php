<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'door-log-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'record_type',array('class'=>'span5','maxlength'=>16)); ?>

	<?php echo $form->textFieldRow($model,'badge',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'entry_date_time',array('class'=>'span5')); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
