<?php
$this->breadcrumbs=array(
	'Door Logs',
);

$this->menu=array(
array('label'=>'Create DoorLog','url'=>array('create')),
array('label'=>'Manage DoorLog','url'=>array('admin')),
);
?>

<h1>Door Logs</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
