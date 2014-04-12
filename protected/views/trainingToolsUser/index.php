<?php
/* @var $this TrainingToolsUserController */

$this->breadcrumbs=array(
	'My Tool Access',
);
?>
<h2>My Tool Access</h2>
<p>
This page shows the tools you have obtained training for and the combination lock codes for those tools.
</p>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$this->gridDataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'tool_name', 'header'=>'Tool Name'),
        array('name'=>'combination_lock_code', 'header'=>'Combination Lock Code'),
    ),
)); ?>