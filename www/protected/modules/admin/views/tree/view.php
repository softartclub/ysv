<?php
/* @var $this treeController */
/* @var $model tree */

$this->breadcrumbs=array(
	Yii::t('interface', 'Tree')=>array('index'),
	$model->name,
);



$this->menu=array(
	array('label'=>Yii::t('interface', 'List tree'), 'url'=>array('index')),
	array('label'=>Yii::t('interface', 'Create tree'), 'url'=>array('create')),
        array('label'=>Yii::t('interface', 'Update tree'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('interface', 'Delete tree'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),

	array('label'=>Yii::t('interface', 'Manage trees'), 'url'=>array('admin')),
);
?>

<h1>View tree #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		
		'name',
		'url',
		'controller'
		
	),
)); ?>
