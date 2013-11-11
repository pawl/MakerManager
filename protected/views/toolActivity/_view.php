<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('whmcs_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->whmcs_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tool_id')); ?>:</b>
	<?php echo CHtml::encode($data->tool_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activity_start')); ?>:</b>
	<?php echo CHtml::encode($data->activity_start); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activity_end')); ?>:</b>
	<?php echo CHtml::encode($data->activity_end); ?>
	<br />


</div>