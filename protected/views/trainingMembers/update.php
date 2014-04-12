<?php
$this->breadcrumbs=array(
	'Training Members'=>array('admin'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TrainingMembers','url'=>array('index')),
	array('label'=>'Create TrainingMembers','url'=>array('create')),
	array('label'=>'View TrainingMembers','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TrainingMembers','url'=>array('admin')),
	);
	?>

	<h1>Update TrainingMembers <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>