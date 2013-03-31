<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
        Yii::t('interface', $this->module->id)=>'/admin',
	Yii::t('interface', 'Pages')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('interface','Update'),
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'Create page'), 'url'=>array('create')),
	array('label'=>Yii::t('interface', 'List Pages'), 'url'=>array('index')),
	
	array('label'=>Yii::t('interface', 'Manage Pages'), 'url'=>array('admin')),
        array('label'=>Yii::t('interface', 'View'), 'url'=>array('view', 'id'=>$model->id)),
      
	
);
?>

<h1><?php echo Yii::t('form', 'Update Pages')." (". $model->name .") ";  ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree, 'treeSelected'=>$treeSelected, 'treeList'=>$treeList, 'img'=>$img)); ?>