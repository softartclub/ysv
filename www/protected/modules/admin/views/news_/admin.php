<?php
/* @var $this PagesController */
/* @var $model Pages */

$this->breadcrumbs=array(
	'Pages'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Pages', 'url'=>array('index')),
	array('label'=>'Create Pages', 'url'=>array('create')),
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

<h1>Manage Pages</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pages-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    
	'columns'=>array(
		'id',
		
		'name',
		'url',
		'header',
		'title',
                
		/*
		'keywords',
		'description',
		'preview',
		'body',
		'lang',
		'domain',
		*/
		array(
			'class'=>'CButtonColumn',
              /*      'buttons' => array(
  'btnDefault' => array(
   'label'  => 'Будет отображаться при загрузке модуля',
   'url'   => 'array("admin/page/default/", "pg_is_default" => $data -> pg_is_default, "pg_id" => $data -> pg_id)',
   'imageUrl'  => '/images/icons/icon10-warm_arrow0.gif',
   'options' => array('class' => 'is_btn_default'),
  )),*/
		),
            
	),
)); ?>
