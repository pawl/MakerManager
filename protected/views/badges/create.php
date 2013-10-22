<?php
$this->breadcrumbs=array(
	'Badges'=>array('admin'),
	'Create',
);

/* if (Yii::app()->user->getId() == "admin") {
	$this->menu=array(
	array('label'=>'Manage Badges','url'=>array('admin')),
	);
} */
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-success flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<h2>Badge Request Form</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<script>
$('#sendit').attr('disabled', 'disabled');
$('.btn-group').mouseup(function() {
	setTimeout(function() {
		if ($('#yw0').hasClass('active')) {
			$('#sendit').attr('disabled', false);
		} else {
			$('#sendit').attr('disabled', 'disabled');
		}
	}, 100);
})
</script>