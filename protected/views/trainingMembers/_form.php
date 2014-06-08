<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'training-members-form',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	<?php 
		echo CHtml::label('<strong>User E-mail</strong>', 'whmcs_user_id', array('style' => 'display: inline;'));
		echo '<span class="required" style="display: inline-block;">*</span>';
		echo '<br><small>Note: Only showing members with an active badge.</small><br>';
		// whmcsUserListData function will grab the list of whmcs_user_ids + emails 
		echo $form->dropDownList($model, 'whmcs_user_id', $this->activeUserList(), array('empty'=>'Select User by Email')); 
	?>
	
	<div>
		<?php 
			echo CHtml::label('Tool', 'TrainingMembers_tool_id', array('style' => 'display: inline;'));
			echo '<span class="required" style="display: inline-block;">*</span><br>';
			echo $form->dropDownList($model,'tool_id', CHtml::listData(TrainingTools::model()->findAll(), 'id', 'tool_name'), array('empty'=>'Select Tool')); 
		?>
	</div>

	<div>
		<?php 
			echo CHtml::label('Trainer', 'TrainingMembers_trainer_id', array('style' => 'display: inline;'));
			echo '<span class="required" style="display: inline-block;">*</span><br>';
			echo $form->dropDownList($model,'trainer_id', CHtml::listData(TrainingTrainers::model()->findAll(), 'whmcs_user_id', 'whmcs.email'), array('empty'=>'Select Trainer By Email')); 
		?>
	</div>
	
	<?php //echo $form->textFieldRow($model,'status',array('class'=>'span5','maxlength'=>12)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>
