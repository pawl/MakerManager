<?php
$this->breadcrumbs=array(
	'Tool Activity'=>array('admin'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('tool-activity-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1 style="margin:0; margin-bottom: 5px;">Tool Activity</h1>

<p>This page is intended for administrators and is used for viewing when the RFID interlock was used.</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'tool-activity-grid',
'dataProvider'=>$model->search(),
'template' => "{items}",
'filter'=>$model,
'columns'=>array(
		array(
			'type'=>'raw',
			'header'=>'User',
			'value'=>'$data->whmcs->firstname . " " . $data->whmcs->lastname',
		),
		'tools.tool_name',
		'activity_start',
		'activity_end',
),
)); ?>
