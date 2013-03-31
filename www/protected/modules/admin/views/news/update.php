<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
        Yii::t('interface', $this->module->id)=>'/admin',
	Yii::t('interface', 'News')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('interface','Update News'),
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'Create News'), 'url'=>array('create')),
	array('label'=>Yii::t('interface', 'List News'), 'url'=>array('index')),
	
	array('label'=>Yii::t('interface', 'Manage News'), 'url'=>array('admin')),
        array('label'=>Yii::t('interface', 'View'), 'url'=>array('view', 'id'=>$model->id)),
      
	
);
?>

<h1><?php echo Yii::t('interface', 'Update News')." (". $model->name .") ";  ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree, 'treeSelected'=>$treeSelected, 'treeList'=>$treeList, 'img'=>$img)); ?>