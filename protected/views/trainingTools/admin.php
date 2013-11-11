<?php
$this->breadcrumbs=array(
	'Training Tools'=>array('index'),
	'Manage',
);

/* $this->menu=array(
array('label'=>'List TrainingTools','url'=>array('index')),
array('label'=>'Create TrainingTools','url'=>array('create')),
); */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('training-tools-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="row">
	<span class="pull-left span6"><h1>Manage Tools</h1></span>
	<span class="span6">
		<span class="pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'New Tool',
			'url' => Yii::app()->createUrl('/TrainingTools/create'),
			'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'large', // null, 'large', 'small' or 'mini'
		)); ?>
		</span>
	</span>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'training-tools-grid',
'dataProvider'=>$model->search(),
'template' => "{items}",
'filter'=>$model,
'columns'=>array(
		'id',
		'tool_mac_address',
		'tool_name',
		'timeout',
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
