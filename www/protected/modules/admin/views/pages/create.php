<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
         Yii::t('interface', $this->module->id)=>'/admin',
	Yii::t('interface', 'Pages')=>array('index'),
	Yii::t('interface', 'Create')
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'List Pages'), 'url'=>array('index')),
	array('label'=>Yii::t('interface', 'Manage Pages'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('interface', 'Create page');?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree, 'treeSelected'=>$treeSelected, 'treeList'=>$treeList, 'img'=>$img)); ?>