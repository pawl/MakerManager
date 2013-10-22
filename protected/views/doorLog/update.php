<?php
$this->breadcrumbs=array(
	'Door Logs'=>array('index'),
	$model->RID=>array('view','id'=>$model->RID),
	'Update',
);

	$this->menu=array(
	array('label'=>'List DoorLog','url'=>array('index')),
	array('label'=>'Create DoorLog','url'=>array('create')),
	array('label'=>'View DoorLog','url'=>array('view','id'=>$model->RID)),
	array('label'=>'Manage DoorLog','url'=>array('admin')),
	);
	?>

	<h1>Update DoorLog <?php echo $model->RID; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>