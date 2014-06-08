<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'badges-form',
	'enableAjaxValidation'=>false,
)); ?>

<style>
.formField {
	margin-bottom: 20px;
}
</style>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
	
	<br>
	<div class='formField'>
		<?php 
		echo CHtml::label('<strong>Member Name</strong>', 'whmcs_user_id', array('style' => 'display: inline;'));
		echo '<span class="required" style="display: inline-block;">*</span>';
		echo '<br><small>Note: Only showing paid members without an active badge.</small><br>';
		// noBadgeUserList function will grab the list of whmcs_user_ids + emails 
		echo $form->dropDownList($model, 'whmcs_user_id', $this->noBadgeUserList(), array('empty'=>'Select Name')); 
		?>
	</div>
	
	<div class='formField'>
		<?php 
		echo CHtml::label('<strong>Badge Number</strong>', 'badge', array('style' => 'display: inline;'));
		echo '<span class="required" style="display: inline-block;">*</span>';
		echo '<br><small>Note: If it\'s a card, it\'s only the first number on the left. (usually starts with a zero)</small><br>';
		echo $form->textFieldRow($model,'badge',array('class'=>'span2', 'labelOptions' => array('label' => false))); 
		?>
	</div>
	
	<?php 
	echo "<div class='formField'>";
	echo CHtml::label('<strong>Has the member signed a <a href="https://dallasmakerspace.org/wiki/File:Access_Acknowledgement_and_Liability_Release.pdf">liability waiver</a>?</strong>', 'liabilityWaiver', array('style' => 'display: inline;'));
	echo "<span class='required' style='display: inline-block;'>*</span>
	<br>
	<small>Note: You can scan it and place it on top of the file cabinet in the security room.</small>
	<br>";
	$this->widget(
	'bootstrap.widgets.TbButtonGroup',
	array(
		'toggle' => 'radio',
		'id' => 'liabilityWaiver',
		'buttons' => array(
			array('label' => 'Yes'),
			array('label' => 'No'),
		),
	)
	);
	echo "</div>";
	?>
	
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'id'=>'sendit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Submit Request' : 'Save',
			'htmlOptions'=>array('class'=>"btn-large"),
		)); ?>

<?php $this->endWidget(); ?>
