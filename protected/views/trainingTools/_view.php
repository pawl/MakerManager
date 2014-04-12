<?php
/* @var $this TrainingToolsController */
/* @var $data TrainingTools */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tool_mac_address')); ?>:</b>
	<?php echo CHtml::encode($data->tool_mac_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tool_name')); ?>:</b>
	<?php echo CHtml::encode($data->tool_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timeout')); ?>:</b>
	<?php echo CHtml::encode($data->timeout); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('combination_lock_code')); ?>:</b>
	<?php echo CHtml::encode($data->combination_lock_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('combination_lock_code_length')); ?>:</b>
	<?php echo CHtml::encode($data->combination_lock_code_length); ?>
	<br />


</div>