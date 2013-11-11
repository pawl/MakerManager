<?php
$this->breadcrumbs=array(
	'Tool Activities'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List ToolActivity','url'=>array('index')),
array('label'=>'Manage ToolActivity','url'=>array('admin')),
);
?>

<h1>Create ToolActivity</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>