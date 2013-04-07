<h1><?php echo Yii::t('interface', 'Sitemap'); ?></h1>
<div id="sidebar">
    <?php
    $this->widget('application.widgets.menu.SiteMenu', array(
        'htmlOptions' => array('class' => 'nav'),
        'name' => 'Horisontal menu',
        'linkLabelWrapper' => 'span',
        'activeCssClass' => 'current',
        'items' => array(
            array('label' => Yii::t('interface', 'Home'), 'url' => array('/site/index')),
            array('label' => Yii::t('interface', 'About'), 'url' => array('/site/page', 'view' => 'about')),
            array('label' => Yii::t('interface', 'Contact'), 'url' => array('/site/contact')),
            
        ),
    ));
  
    $this->widget('application.widgets.menu.SiteMenu', array(
        'htmlOptions' => array('class' => 'v_menu_left1')
    ));
    ?>
</div>
