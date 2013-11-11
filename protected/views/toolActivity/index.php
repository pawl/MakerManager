<?php
$this->breadcrumbs=array(
	'Tool Activities',
);

$this->menu=array(
array('label'=>'Create ToolActivity','url'=>array('create')),
array('label'=>'Manage ToolActivity','url'=>array('admin')),
);
?>

<h1>Tool Activities</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
