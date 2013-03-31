<h2><?php echo Yii::t('form', 'Files are deleted');?></h2>
<hr>
<?php echo $deletedFiles;?>
<hr>
<a href ="/admin"><?php echo Yii::t('form', 'Back to main');?></a>  |
<a href ="/admin/<?php echo Yii::app()->controller->id?>/update/id/<?php echo $id;?>"><?php echo Yii::t('form', 'Back to update');?></a>  

