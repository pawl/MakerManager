<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'training-trainers-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php 
	echo CHtml::label('Trainer', 'TrainingTrainers_whmcs_user_id', array('style' => 'display: inline;'));
	echo '<span class="required" style="display: inline-block;">*</span><br>';
	echo $form->dropDownList($model, 'whmcs_user_id', $this->activeUserList(), array('empty'=>'Select Trainer by Email')); 
	?>
	
	<div>
		<?php 
		echo CHtml::label('Tool', 'TrainingTrainers_tool_id', array('style' => 'display: inline;'));
		echo '<span class="required" style="display: inline-block;">*</span><br>';
		echo $form->dropDownList($model,'tool_id', CHtml::listData(TrainingTools::model()->findAll(), 'id', 'tool_name'), array('empty'=>'Select Tool')); 
		?>
	</div>

<div class="form-actions">
	<?php 
	$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); 
	?>
</div>

<?php $this->endWidget(); ?>
