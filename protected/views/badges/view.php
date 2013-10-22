<?php
$this->breadcrumbs=array(
	'Badges'=>array('admin'),
	$model->whmcs_user_id,
);

$this->menu=array(
array('label'=>'Request Badge','url'=>array('create')),
array('label'=>'Update Badge','url'=>array('update','id'=>$model->whmcs_user_id)),
//array('label'=>'Delete Badge','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->whmcs_user_id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Badges','url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->whmcs_user_id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'whmcs_user_id',
		'badge',
		'status',
),
)); ?>
