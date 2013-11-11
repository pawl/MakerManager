<?php
$this->breadcrumbs=array(
	'Training Trainers'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TrainingTrainers','url'=>array('index')),
array('label'=>'Create TrainingTrainers','url'=>array('create')),
array('label'=>'Update TrainingTrainers','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete TrainingTrainers','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TrainingTrainers','url'=>array('admin')),
);
?>

<h1>View TrainingTrainers #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'whmcs_user_id',
		'trainer_name',
		'tool_id',
		'status',
),
)); ?>
