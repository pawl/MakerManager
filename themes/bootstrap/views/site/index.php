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
		<li>Allows us to directly link users to their billing account while allowing them to use their usual login information.</li>
		<li>Request an RFID badge for yourself or other members.</li>
		<li>For administrators, it provides a self documenting solution for adding badges to the access control system along with an easy way to manage them.
		</ul>
	</p>
	<!-- <br>
	<p>
	<?php 
		//if (Yii::app()->user->getId() == "admin") { ?>
		<a class="btn btn-large btn-primary" href="<?php //echo $this->whmcsUrl("clientarea.php"); ?>">Billing Account</a> 
		<a class="btn btn-large" href="<?php //echo Yii::app()->createUrl('/badges/create'); ?>">Request Badge</a>
		<a class="btn btn-large" href="<?php //echo Yii::app()->createUrl('/badges/admin'); ?>">Manage Badges</a>		
	<?php //} elseif (!Yii::app()->user->isGuest) { ?>
		<a class="btn btn-large btn-primary" href="<?php //echo $this->whmcsUrl("clientarea.php"); ?>">Billing Account</a> 
		<a class="btn btn-large" href="<?php //echo Yii::app()->createUrl('/badges/create'); ?>">Request Badge</a>
	<?php //} else { ?>
		<a class="btn btn-large btn-primary" href="<?php //echo Yii::app()->createUrl('/site/login'); ?>">Login</a> 
	<?php //} ?>
	</p>
	-->
</div>

