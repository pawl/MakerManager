<?php
$this->breadcrumbs=array(
	'Training Members'=>array('admin'),
	'Create',
);

$this->menu=array(
array('label'=>'List TrainingMembers','url'=>array('index')),
array('label'=>'Manage TrainingMembers','url'=>array('admin')),
);
?>

<h1>Training Approval Form</h1>
<p>This training request form is intended for users who have completed training and need to be marked as trained in this system.</p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>