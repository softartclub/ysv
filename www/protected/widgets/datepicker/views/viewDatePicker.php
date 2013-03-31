<script type="text/javascript">
    //
    $(function() { 
        $( "#datepicker" ).datepicker({
            'dateFormat':'yy-mm-dd',
            'changeMonth': true,
            'changeYear': true,
            'monthNamesShort' : [ '<?php echo Yii::t('interface', 'Jan');?>', 
                '<?php echo Yii::t('interface', 'Feb');?>', 
                '<?php echo Yii::t('interface', 'Mar');?>', 
                '<?php echo Yii::t('interface', 'Apr');?>', 
                '<?php echo Yii::t('interface', 'May');?>', 
                '<?php echo Yii::t('interface', 'Jun');?>', 
                '<?php echo Yii::t('interface', 'Jul');?>', 
                '<?php echo Yii::t('interface', 'Aug');?>', 
                '<?php echo Yii::t('interface', 'Sep');?>', 
                '<?php echo Yii::t('interface', 'Oct');?>', 
                '<?php echo Yii::t('interface', 'Nov');?>', 
                '<?php echo Yii::t('interface', 'Dec');?>' ],
            'dayNamesMin':['<?php echo Yii::t('interface', 'Su');?>',
                '<?php echo Yii::t('interface', 'Mo');?>',
                '<?php echo Yii::t('interface', 'Tu');?>',
                '<?php echo Yii::t('interface', 'We');?>',
                '<?php echo Yii::t('interface', 'Th');?>',
                '<?php echo Yii::t('interface', 'Fr');?>',
                '<?php echo Yii::t('interface', 'Sa');?>']
        });
    });
</script>
