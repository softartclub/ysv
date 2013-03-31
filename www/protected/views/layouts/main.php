<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>



            .wrapper .col-1{
                margin-bottom: 50px;
            }

            .wrapper h3 {
                border-bottom: 1px solid #C9E0ED;
            }

            .box1 .img {     
                margin-right: 10px;
            }

            .v_menu_left li {
                list-style: none;
            }
            
            

            .v_menu_left li.v_menu div {
                padding: 4px;
                margin-bottom: 5px;
                background: url("/css/bg.gif") repeat-x scroll left top white;
       
            }
            
            .v_menu_left li.v_menu div.menu_slider {
                background: none;
            }
            
           
             .v_menu_left li.v_menu div  a {
                color: #ffffff;
                text-decoration: none;
            }


        </style>
    </head>

    <body>

        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('application.widgets.menu.VMenu', array(
                    'htmlOptions' => array('class' => 'nav'),
                    'name' => 'Horisontal menu',
                    'type' => 'close',
                    'linkLabelWrapper' => 'span',
                    'activeCssClass' => 'current',
                    'items' => array(
                        array('label' => 'Home', 'url' => array('/site/index')),
                        array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                        //    array('label' => 'Contact', 'url' => array('/site/contact')),
                        array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
<?php endif ?>

<?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
                All Rights Reserved.<br/>
<?php echo Yii::powered(); ?>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
