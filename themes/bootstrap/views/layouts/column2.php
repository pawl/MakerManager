<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    <div class="span12">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <!-- <div class="span3">
        <div id="sidebar">
        <?php
            /* $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Operations',
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget(); */
        ?>
        </div>
    </div> -->
</div>
<?php $this->endContent(); ?>