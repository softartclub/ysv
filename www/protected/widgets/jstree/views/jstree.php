<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/js/jstree/themes/default/style.css?v=1.2" /> 
<script src="<?php echo Yii::app()->theme->baseUrl ?>/js/jstree/jquery.jstree.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/jstree/_lib/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl ?>/js/jstree/_lib/jquery.hotkeys.js"></script>


<script type="text/javascript">
    jQuery(function() {
        $('.menu').jstree({
            
        
        });
    });
    
  
    
</script>
<div class="menu">
    <?php echo $menu;?>
</div>