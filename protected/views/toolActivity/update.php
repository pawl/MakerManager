<?php
$this->breadcrumbs=array(
	'Tool Activities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List ToolActivity','url'=>array('index')),
	array('label'=>'Create ToolActivity','url'=>array('create')),
	array('label'=>'View ToolActivity','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage ToolActivity','url'=>array('admin')),
	);
	?>

	<h1>Update ToolActivity <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>