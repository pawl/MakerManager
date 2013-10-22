<?php
$this->breadcrumbs=array(
	'Door Logs'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List DoorLog','url'=>array('index')),
array('label'=>'Manage DoorLog','url'=>array('admin')),
);
?>

<h1>Create DoorLog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>