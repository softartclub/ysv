<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
        Yii::t('interface', $this->module->id)=>'/admin',
	Yii::t('interface', 'News')=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'List News'), 'url'=>array('index')),
	array('label'=>Yii::t('interface', 'Create News'), 'url'=>array('create')),
	array('label'=>Yii::t('interface', 'Update News'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('interface', 'Delete News'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('interface', 'Are you sure you want to delete this item?'))),
	
	array('label'=>Yii::t('interface', 'Manage News'), 'url'=>array('admin')),
    
);
?>

<h1><?php echo Yii::t('interface', 'View News')." (". $model->header .")"; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		'date',
                array(
                    'name'=>'author',
                    'value'=>Yii::app()->user->getName()." (". Yii::app()->user->getUserGroupById($model ->author).")"
                ),
		'header',
		'title',
		'keywords',
		'description',
		array(
                    'name'=>'pic', 
                    'type'=>'html',
                    'value'=>(
                            is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/big/' . $model->pic) ?
                            CHtml::image('/img/news/big/' . $model->pic, $model->name)
                            :'')),
		array('name'=>'preview', 'type'=>'html'),
		array('name'=>'body', 'type'=>'html'),
		
	),
)); ?>
