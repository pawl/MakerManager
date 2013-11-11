<?php
$this->breadcrumbs=array(
	'Training Trainers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TrainingTrainers','url'=>array('index')),
	array('label'=>'Create TrainingTrainers','url'=>array('create')),
	array('label'=>'View TrainingTrainers','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TrainingTrainers','url'=>array('admin')),
	);
	?>

	<h1>Update TrainingTrainers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>