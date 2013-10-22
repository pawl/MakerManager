<?php
$this->breadcrumbs=array(
	'Badges',
);

$this->menu=array(
array('label'=>'Add Badge','url'=>array('create')),
array('label'=>'Manage Badges','url'=>array('admin')),
);
?>

<h1>Badges</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
