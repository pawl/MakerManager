<?php
$this->breadcrumbs=array(
	'Training Trainers'=>array('index'),
	'Manage',
);

$this->menu=array(
array('label'=>'List TrainingTrainers','url'=>array('index')),
array('label'=>'Create TrainingTrainers','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('training-trainers-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<div class="row">
	<span class="pull-left span6"><h1>Manage Trainers</h1></span>
	<span class="span6">
		<span class="pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'New Trainer',
			'url' => Yii::app()->createUrl('/TrainingTrainers/create'),
			'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'large', // null, 'large', 'small' or 'mini'
		)); ?>
		</span>
	</span>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'training-trainers-grid',
'template' => "{items}",
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'id',
		'whmcs_user_id',
		'trainer_name',
		'tool_id',
		array( 
              'class' => 'editable.EditableColumn',
              'name' => 'status',
              'headerHtmlOptions' => array('style' => 'width: 100px'),
              'editable' => array(
                  'type'     => 'select',
                  'url'      => $this->createUrl('editable'),
                  'source'   => Editable::source(array('Active' => 'Active', 'Inactive' => 'Inactive')),
				  'emptytext' => 'Pending',
              )
        ),
array(
'class'=>'bootstrap.widgets.TbButtonColumn',
),
),
)); ?>
