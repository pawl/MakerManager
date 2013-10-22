<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('RID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->RID),array('view','id'=>$data->RID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('record_type')); ?>:</b>
	<?php echo CHtml::encode($data->record_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('badge')); ?>:</b>
	<?php echo CHtml::encode($data->badge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entry_date_time')); ?>:</b>
	<?php echo CHtml::encode($data->entry_date_time); ?>
	<br />


</div>