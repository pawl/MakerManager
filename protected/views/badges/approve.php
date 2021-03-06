<?php
$this->breadcrumbs=array(
	'Badges'=>array('admin'),
	'Manage',
);

/* $this->menu=array(
array('label'=>'Request Badge','url'=>array('create')),
); */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('badges-grid', {
data: $(this).serialize()
});
return false;
});
");
?>
<div class="row span12"><small>Note: You will need to click the "update" button on each row and change the status to "Active" in order to approve.</small></div>
<div class="row span12">
<span class="pull-left"><h1>Badges Pending Approval</h1></span>
<span class="pull-right">
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'New Badge',
	'url' => Yii::app()->createUrl('/badges/create'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Manage Badges',
	'url' => Yii::app()->createUrl('/badges/admin'),
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
	'htmlOptions'=>array('style'=>'margin-left: 10px;'),
)); ?>
</span>
</div>

<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
'id'=>'badges-grid',
'template' => "{items}",
'dataProvider'=>$dataProvider,
'columns'=>array(
		'fullname',
		'email',
		'badge',
		'status',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{update}',
		),
),
)); ?>
