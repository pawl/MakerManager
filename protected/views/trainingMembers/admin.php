<?php
$this->breadcrumbs=array(
	'Training'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List TrainingMembers','url'=>array('index')),
array('label'=>'Create TrainingMembers','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('training-members-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="row">
	<span class="pull-left span6"><h1>Manage Training</h1></span>
	<span class="span6">
		<span class="pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'Add Training',
			'url' => Yii::app()->createUrl('/TrainingMembers/create'),
			'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'large', // null, 'large', 'small' or 'mini'
		)); ?>
		</span>
	</span>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'training-members-grid',
'template' => "{items}",
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		//'id',
		array(
			'type'=>'raw',
			'header'=>'Name',
			'value'=>'$data->whmcs->firstname . " " . $data->whmcs->lastname',
		),
		'tools.tool_name',
		array(
			'type'=>'raw',
			'header'=>'Trainer Name',
			'value'=>'$data->trainers->whmcs->firstname . " " . $data->trainers->whmcs->lastname',
		),
		array( 
              'class' => 'editable.EditableColumn',
              'name' => 'status',
              'headerHtmlOptions' => array('style' => 'width: 100px'),
              'editable' => array(
                  'type'     => 'select',
                  'url'      => $this->createUrl('editable'),
                  'source'   => Editable::source(array('Trained' => 'Trained')),
				  'emptytext' => 'Pending',
              )
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
		),
	),
)); ?>
