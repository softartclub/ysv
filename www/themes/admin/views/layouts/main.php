<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/buttons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/icons.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/tables.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mbmenu_iestyles.css" />

        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.10.1.custom/css/redmond/jquery-ui-1.10.1.custom.min.css" />

        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.10.1.custom/js/jquery-1.9.1.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.10.1.custom/js/jquery-ui-1.10.1.custom.min.js"></script>


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div class="container" id="page">
            <div id="topnav">
                <div class="topnav_text">

                    <a href='/'><?php echo Yii::t('interface', 'Home'); ?></a> |

                    <a href='/admin'><?php echo Yii::t('interface', 'admin'); ?></a> |
                    <a href='/admin/default/settings'><?php echo Yii::t('interface', 'Default settings'); ?></a> |
                    <a href='/site/logout'><?php echo Yii::t('interface', 'Logout'); ?></a> 
                </div>
            </div>
            <div id="header">
                <div id="logo"><!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"> --><?php echo CHtml::encode(Yii::t('interface', 'admin'));  ?></div>
            </div><!-- header -->

            <div id="mainmenu">

                <?php $this->widget('zii.widgets.CMenu', array('items' => $this->_horisontalMenu)); ?>

            </div> <!--mainmenu -->


            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => CHtml::link(Yii::t('interface', 'Home'), '/'),
                ));
                ?><!-- breadcrumbs -->
            <?php endif ?>

<?php echo $content; ?>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by webapplicationthemes.com<br/>
                All Rights Reserved.<br/>
<?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>