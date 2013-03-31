<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
         Yii::t('interface', $this->module->id)=>'/admin',
	Yii::t('interface', 'News')=>array('index'),
	Yii::t('interface', 'Create News')
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'List News'), 'url'=>array('index')),
	array('label'=>Yii::t('interface', 'Manage News'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('interface', 'Create News');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree, 'treeSelected'=>$treeSelected, 'treeList'=>$treeList, 'img'=>$img)); ?>