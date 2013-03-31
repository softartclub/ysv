
<?php
/* @var $this PagesController */
/* @var $dataProvider CActiveDataProvider */
$title = Yii::t('interface', 'News');
$this->breadcrumbs=array(
	Yii::t('interface', $this->module->id)=>'/admin',
	$title,
);

$this->menu=array(
	array('label'=>Yii::t('interface', 'Create'), 'url'=>array('/'.$this->module->id.'/news/create')),
	array('label'=>Yii::t('interface', 'Manage'), 'url'=>array('/'.$this->module->id.'/news/admin')),
);
?>

<h1><?php echo $title;?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,  
       
	'itemView'=>'_view',
)); ?>
