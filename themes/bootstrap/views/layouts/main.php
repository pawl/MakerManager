<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array('label'=>'Billing Account', 'url'=>$this->whmcsUrl(), 'visible'=>!Yii::app()->user->isGuest),
                array('label'=>'Request Badge', 'url'=>array('/badges/create'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Manage Badges', 'url'=>array('/badges/admin'), 'visible'=>Yii::app()->user->getId() == "admin"),
				array('label'=>'Training', 
					'items' => array(
					array('label' => 'My Tool Access', 'url' => array('/TrainingToolsUser/index')),
                    array('label' => 'Request Training Approval', 'url' => array('/TrainingMembers/create')),
                    array('label' => 'Trained Members', 'url' => array('/TrainingMembers/admin')),
                    array('label' => 'Tools', 'url' => array('/TrainingTools/admin')),
                    array('label' => 'Tool Activity', 'url' => array('/ToolActivity/admin')),
                    array('label' => 'Trainers', 'url' => array('/TrainingTrainers/admin')),
					),
					'visible'=>!Yii::app()->user->isGuest,
				),
				//array('label'=>'Door Log', 'url'=>array('/DoorLog/index')),
                //array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                //array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<!-- <div id="footer">
		Copyright &copy; <?php //echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php //echo Yii::powered(); ?>
	</div> -->
	<!-- footer -->

</div><!-- page -->

</body>
</html>
