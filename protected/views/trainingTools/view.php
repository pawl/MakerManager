<?php
$this->breadcrumbs=array(
	'Training Tools'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List TrainingTools','url'=>array('index')),
array('label'=>'Create TrainingTools','url'=>array('create')),
array('label'=>'Update TrainingTools','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete TrainingTools','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage TrainingTools','url'=>array('admin')),
);
?>

<h1>View TrainingTools #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'tool_mac_address',
		'tool_name',
		'timeout',
),
)); ?>
