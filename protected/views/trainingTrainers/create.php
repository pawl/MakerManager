<?php
$this->breadcrumbs=array(
	'Training Trainers'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TrainingTrainers','url'=>array('index')),
array('label'=>'Manage TrainingTrainers','url'=>array('admin')),
);
?>

<h2>Add Trainer</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>