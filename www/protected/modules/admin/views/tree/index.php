<?php
/* @var $this treeController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs=array(
	Yii::t('interface', 'Tree')=>array('index'),
	Yii::t('interface','Manage'),
);

$this->menu=array(
    array('label'=>Yii::t('interface', 'Create tree')   , 'url'=>array('create')),
	array('label'=>Yii::t('interface', 'Manage trees'), 'url'=>array('admin')),
	
);
?>



<h1><?php echo Yii::t('interface', 'Tree');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
