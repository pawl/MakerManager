<?php
$this->breadcrumbs=array(
	'Tool Activities'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List ToolActivity','url'=>array('index')),
array('label'=>'Create ToolActivity','url'=>array('create')),
array('label'=>'Update ToolActivity','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete ToolActivity','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage ToolActivity','url'=>array('admin')),
);
?>

<h1>View ToolActivity #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'whmcs_user_id',
		'tool_id',
		'activity_start',
		'activity_end',
),
)); ?>
