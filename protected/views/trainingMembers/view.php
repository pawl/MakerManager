<?php
$this->breadcrumbs=array(
	'Training Members'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TrainingMembers','url'=>array('index')),
array('label'=>'Create TrainingMembers','url'=>array('create')),
array('label'=>'Update TrainingMembers','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete TrainingMembers','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TrainingMembers','url'=>array('admin')),
);
?>

<h1>View TrainingMembers #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'whmcs_user_id',
		'tool_id',
		'trainer_id',
		'status',
),
)); ?>
