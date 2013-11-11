<?php
$this->breadcrumbs=array(
	'Training Members'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List TrainingMembers','url'=>array('index')),
array('label'=>'Manage TrainingMembers','url'=>array('admin')),
);
?>

<h1>Training Request Form</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>