<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	Yii::t('interface', 'Tree')=>array('index'),
	Yii::t('interface',$model->name)=>array('view','id'=>$model->id),
	Yii::t('interface', 'Update'),
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'List tree'), 'url'=>array('index')),
	array('label'=>Yii::t('interface', 'Create tree'), 'url'=>array('create')),
	array('label'=>Yii::t('interface', 'View tree'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('interface', 'Manage trees'), 'url'=>array('admin')),
);
?>

<h1> <?php echo Yii::t('interface', 'Update tree').' '.  $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array(
    'model'=>$model, 
    'modules'=>$modules, 
    'isHorisontalMenu' => $isHorisontalMenu,
    'isVerticalMenu' => $isVerticalMenu,
    'parent'=>$parent
    )); ?>