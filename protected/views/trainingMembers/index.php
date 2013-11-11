<?php
$this->breadcrumbs=array(
	'Training Members',
);

$this->menu=array(
array('label'=>'Create TrainingMembers','url'=>array('create')),
array('label'=>'Manage TrainingMembers','url'=>array('admin')),
);
?>

<h1>Training Members</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
