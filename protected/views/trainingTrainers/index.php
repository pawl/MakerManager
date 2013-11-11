<?php
$this->breadcrumbs=array(
	'Training Trainers',
);

$this->menu=array(
array('label'=>'Create TrainingTrainers','url'=>array('create')),
array('label'=>'Manage TrainingTrainers','url'=>array('admin')),
);
?>

<h1>Training Trainers</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
