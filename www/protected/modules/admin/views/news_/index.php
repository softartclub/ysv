<?php
/* @var $this PagesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('interface', $this->module->id)=>'/admin',
	Yii::t('interface', 'News'),
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'Create'), 'url'=>array('/'.$this->module->id.'/news/create')),
	array('label'=>Yii::t('interface', 'Manage'), 'url'=>array('/'.$this->module->id.'/news/admin')),
);
?>

<h1><?php echo Yii::t('interface', 'News');?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
