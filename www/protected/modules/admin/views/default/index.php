<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    Yii::t('interface', $this->module->id),
);
?>
<div class="span-23 showgrid">
    <div class="dashboardIcons span-16">


        <?php foreach ($mainIconsArray as $name => $item): ?>
            <div class="dashIcon span-3">
                <a href="<?php echo $item['controller']; ?>"><img alt="<?php echo Yii::t('interface', $name); ?>" src="<?php echo $item['icons']; ?>"></a>
                <div class="dashIconText "><a href="<?php echo $item['controller']; ?>"><?php echo Yii::t('interface', $name); ?></a></div>
            </div>
        <?php endforeach; ?>





    </div><!-- END OF .dashIcons -->
   
    


</div>