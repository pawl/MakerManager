<?php
$this->breadcrumbs=array(
	'Training Tools',
);

$this->menu=array(
array('label'=>'Create TrainingTools','url'=>array('create')),
array('label'=>'Manage TrainingTools','url'=>array('admin')),
);
?>

<h1>Training Tools</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
