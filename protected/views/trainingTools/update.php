<?php
$this->breadcrumbs=array(
	'Training Tools'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List TrainingTools','url'=>array('index')),
	array('label'=>'Create TrainingTools','url'=>array('create')),
	array('label'=>'View TrainingTools','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage TrainingTools','url'=>array('admin')),
	);
	?>

	<h1>Update TrainingTools <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>