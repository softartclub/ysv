<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	Yii::t('form','News')=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	Yii::t('form', 'Update'),
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
	array('label'=>'View Pages', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pages', 'url'=>array('admin')),
);
?>

<h1>Update Pages <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'tree'=>$tree, 'treeSelected'=>$treeSelected, 'treeList'=>$treeList, 'img'=>$img)); ?>