<?php
$this->breadcrumbs=array(
	'Badges'=>array('admin'),
	$model->whmcs_user_id=>array('view','id'=>$model->whmcs_user_id),
	'Update',
);

	$this->menu=array(
	array('label'=>'Request Badge','url'=>array('create')),
	array('label'=>'View Badge','url'=>array('view','id'=>$model->whmcs_user_id)),
	array('label'=>'Manage Badges','url'=>array('admin')),
	);
	?>
	
<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert flash-' . $key . '">' . $message . "</div>\n";
    }
?>
	<h1>Update User: <?php echo $model->fullname; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>