<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('whmcs_user_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->whmcs_user_id),array('view','id'=>$data->whmcs_user_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('badge')); ?>:</b>
	<?php echo CHtml::encode($data->badge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>