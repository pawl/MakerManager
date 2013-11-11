<?php
$this->breadcrumbs=array(
	'Training Tools'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TrainingTools','url'=>array('index')),
array('label'=>'Manage TrainingTools','url'=>array('admin')),
);
?>

<h1>New Tool</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>