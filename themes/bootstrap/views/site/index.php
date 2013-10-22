<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<div class="hero-unit">
	<h1>Welcome to <?php echo CHtml::encode(Yii::app()->name) ?></h1>
	<p>
		<h4>Maker Manager is used to connect the various systems we use to run Dallas Makerspace.</h4>
		Features:
		<ul>
		<li>View your billing account without logging into a separate system.</li>
		<li>Request an RFID badge for yourself or other members.</li>
		<li>For administrators, it provides a self documenting solution for adding badges to the access control system along with an easy way to manage them.
		</ul>
	</p><br>
	<p>
	
	<?php 
		if (Yii::app()->user->getId() == "admin") { ?>
		<a class="btn btn-large btn-primary" href="<?php echo $this->whmcsUrl(); ?>">Billing Account</a> 
		<a class="btn btn-large" href="<?php echo Yii::app()->createUrl('/badges/create'); ?>">Request Badge</a>
		<a class="btn btn-large" href="<?php echo Yii::app()->createUrl('/badges/admin'); ?>">Manage Badges</a>		
	<?php } elseif (!Yii::app()->user->isGuest) { ?>
		<a class="btn btn-large btn-primary" href="<?php echo $this->whmcsUrl(); ?>">Billing Account</a> 
		<a class="btn btn-large" href="<?php echo Yii::app()->createUrl('/badges/create'); ?>">Request Badge</a>
	<?php } else { ?>
		<a class="btn btn-large btn-primary" href="<?php echo Yii::app()->createUrl('/site/login'); ?>">Login</a> 
	<?php } ?>
	</p>
</div>

