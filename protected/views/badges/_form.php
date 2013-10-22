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
		// get list of user ids with active badges
		$activeBadges = Yii::app()->db->createCommand()
		->select('whmcs_user_id')
		->from('tbl_badges')
		->where('status=:status', array(':status'=>"Active"))
		->queryColumn();	
		
		$criteria = new CDbCriteria;
		
		// only paid members show in dropdown
		$criteria->addCondition("status='Active'");
		
		// no users with active badges are in the email dropdown
		if ($activeBadges) {
			$activeBadges = implode(",", $activeBadges);
			$criteria->addCondition('id not in (' . $activeBadges . ')');
		}
		$criteria->order = 'email ASC';
		
		if ($model->isNewRecord) {
			echo CHtml::label('<strong>User E-mail</strong>', 'whmcs_user_id', array('style' => 'display: inline;'));
			echo '<span class="required" style="display: inline-block;">*</span>';
			echo '<br><small>Note: Only showing paid members without an active badge.</small><br>';
			echo $form->dropDownList($model,'whmcs_user_id', 
				CHtml::listData(WHMCSclients::model()->findAll($criteria), 'id', 'email'), array('empty'=>'Select User by Email')
			); 
		} else {
			echo '<strong>User E-mail:</strong><br>';
			echo '<h4 style="font-weight: 100;">' . $model->email . '</h4>';
		}
		?>
	</div>
	
	<div class='formField'>
		<?php 
		if ($model->isNewRecord) {
			echo CHtml::label('<strong>Badge Number</strong>', 'badge', array('style' => 'display: inline;'));
			echo '<span class="required" style="display: inline-block;">*</span>';
			echo '<br><small>Note: If it\'s a card, it\'s only the first number on the left. (usually starts with a zero)</small><br>';
			echo $form->textFieldRow($model,'badge',array('class'=>'span2', 'labelOptions' => array('label' => false))); 
		} else {
			echo '<strong>Badge Number:</strong><br>';
			echo '<h4 style="font-weight: 100;">' . $model->badge . '</h4>';
		}
		?>
	</div>
	<?php  
	if (!$model->isNewRecord) {
		echo "<div class='formField'>";
		echo CHtml::label('<strong>Status</strong>', 'status', array('style' => 'display: inline;'));
		echo "<span class='required' style='display: inline-block;'>*</span><br>";
		echo "<small>Note: Setting the user to active/deactivated will activate/deactivate the user in the access control system.</small><br>";
		echo $form->dropDownList($model, 'status', array('Active' => 'Active', 'Deactivated' => 'Deactivated', 'Pending' => 'Pending'), array('class'=>'span2','maxlength'=>16));
		echo "</div>";
	}
	?>
	
	
	<?php 
	if ($model->isNewRecord) {
		echo "<div class='formField'>";
		echo CHtml::label('<strong>Has the user signed a <a href="https://dallasmakerspace.org/wiki/File:Access_Acknowledgement_and_Liability_Release.pdf">liability waiver</a>?</strong>', 'liabilityWaiver', array('style' => 'display: inline;'));
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
	}
	?>
	
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'id'=>'sendit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Submit Request' : 'Save',
			'htmlOptions'=>array('class'=>"btn-large"),
		)); ?>

<?php $this->endWidget(); ?>
