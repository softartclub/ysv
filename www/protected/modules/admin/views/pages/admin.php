

<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs = array(
    Yii::t('interface', $this->module->id)=>'/admin',
    Yii::t('interface', 'Pages') => array('index'),
    Yii::t('interface', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('interface', 'List Pages'), 'url' => array('index')),
    array('label' => Yii::t('interface', 'Create page'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#pages-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('interface', 'Manage Pages'); ?></h1>

<p>
    <?php echo Yii::t('interface', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?>
</p>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'pages-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'name' => 'name',
            'type' => 'html',
            'value' => 'CHtml::link("$data[name]", array("view", "id"=>$data["id"]))'
        ),
        array(
            'name' => 'preview',
            'type' => 'html',
            'value' => 'CHtml::decode(substr( strip_tags($data["preview"]), 0, 200))."..."',
            'htmlOptions' => array('class' => 'preview short')
        ),
        array(
            'name'=>'author',
            'value'=>'Yii::app()->user->getName()." (". Yii::app()->user->getUserGroupById($data["author"]).")"'
        ),
        
       
        'date',
        array(
            'class' => 'CButtonColumn',
        ),
    ),
));
?>
