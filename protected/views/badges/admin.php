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

<div class="row">
	<span class="pull-left span6"><h1>Manage Badges</h1></span>
	<span class="span6">
		<span class="pull-right">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'label'=>'New Badge',
			'url' => Yii::app()->createUrl('/badges/create'),
			'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'large', // null, 'large', 'small' or 'mini'
		)); ?>
		</span>
	</span>
</div>

<?php $this->widget('bootstrap.widgets.TbExtendedGridView',array(
'id'=>'badges-grid',
'template' => "{items}",
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		array(
			'type'=>'raw',
			'header'=>'Name',
			'value'=>'$data->whmcs->firstname . " " . $data->whmcs->lastname',
		),
		'whmcs.email',
		'badge',
		array( 
              'class' => 'editable.EditableColumn',
              'name' => 'status',
              'headerHtmlOptions' => array('style' => 'width: 100px'),
              'editable' => array(
                  'type'     => 'select',
                  'url'      => $this->createUrl('editable'),
                  'source'   => Editable::source(array('Active' => 'Active', 'Deactivated' => 'Deactivated')),
				  'emptytext' => 'Pending',
              )
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{delete}',
			'buttons'=>array(
				'delete'=>array(
					'visible'=>'$data->status=="Pending"',
				),
			)
		),
),
)); ?>
