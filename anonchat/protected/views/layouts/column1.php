<?php /* @var $this Controller */ ?>


<div id="content">


    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            //前面显示首页名字，后面为超链接
            'homeLink'=>CHtml::link('AnonymousChat',Yii::app()->homeUrl),
            'links'=>$this->breadcrumbs,
        )); ?>
    <?php endif ?>
    <?php echo $content; ?>

</div><!-- content -->
<div style="position:fixed;margin:auto;left:0; right:0;width:220px; height:40px; bottom: 5px;font-family:Arial, Helvetica, sans-serif;color:white;"><center style="color: #868686;">&copy; 2014 - <?php echo date('Y'); ?> Earl-Hwong Inc. All Rights Reserved</center></div>


