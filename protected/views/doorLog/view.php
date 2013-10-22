<?php
$this->breadcrumbs=array(
	'Door Logs'=>array('index'),
	$model->RID,
);

$this->menu=array(
array('label'=>'List DoorLog','url'=>array('index')),
array('label'=>'Create DoorLog','url'=>array('create')),
array('label'=>'Update DoorLog','url'=>array('update','id'=>$model->RID)),
array('label'=>'Delete DoorLog','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->RID),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage DoorLog','url'=>array('admin')),
);
?>

<h1>View DoorLog #<?php echo $model->RID; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'RID',
		'record_type',
		'badge',
		'entry_date_time',
),
)); ?>
