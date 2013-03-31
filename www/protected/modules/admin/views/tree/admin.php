<style>

    .tree-show {
        background: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/small_icons/24_black/eye_icon24.png) no-repeat scroll 0 0 transparent;
        height: 24px;
        width: 24px;
        display:block;
    }
    .tree-show.hidden {
        background: url(<?php echo Yii::app()->theme->baseUrl; ?>/images/small_icons/24_black/invisible_light_icon24.png) no-repeat scroll 0 0 transparent;
        height: 24px;
        width: 24px;
        display:block;

    }

</style>

<script type="text/javascript">
    $(function() {
        $('.tree-show').click(function() {
            var me = $(this);
            if ($(this).is('.hidden'))
                $.get("/admin/tree/show/id/"+$(this).attr('href')+"/show/1",  function(data){             
                    me.removeClass('hidden');
                }).fail(function(msg){
                    alert("Failed: " + msg.status + ": " + msg.statusText);
                });
                
            else
                 $.get("/admin/tree/show/id/"+$(this).attr('href')+"/show/0",  function(data){             
                    me.addClass('hidden');
                }).fail(function(msg){
                    alert("Failed: " + msg.status + ": " + msg.statusText);
                });
                
   
            return false;
        });


    });

</script>




<?php
/* @var $this treeController */
/* @var $model tree */

$this->breadcrumbs = array(
    Yii::t('interface', 'Tree') => array('index'),
    Yii::t('interface', 'Manage'),
);

$this->menu = array(
    array('label' => Yii::t('interface', 'List tree'), 'url' => array('index')),
    array('label' => Yii::t('interface', 'Create tree'), 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tree-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});


");
?>

<h1><?php echo Yii::t('interface', 'Manage trees'); ?></h1>

<p>
<?php echo Yii::t('interface', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?>
</p>

<?php echo CHtml::link(Yii::t('interface', 'Advanced Search'), '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
<?php
$this->renderPartial('_search', array(
    'model' => $model,
));
?>
</div><!-- search-form -->
<?php
?>
<?php
$this->widget('ext.QTreeGridView.CQTreeGridView', array(
    'id' => 'tree-grid',
    'dataProvider' => $model->search(),

    'ajaxUpdate' => false,
   
    'columns' => array(
     

        array(
            'name'=>'name',
            'value'=>'Yii::t("interface", $data["name"])'
            ),
     //   'url',
        array(
            'name' => 'isShow',
            'type' => 'html',
            'value' => 'CHtml::link("","$data[id]", array("onclick"=>"return false", "class"=>"tree-show". ($data["isShow"] != "1" ? " hidden" : "")))',
            'htmlOptions'=>array('style'=>'text-align: center; width:50px;', 'align'=>'center'),
            
        
        ),
        /*
          'controller',
          'pageId',
         */
        array(
            'class' => 'CButtonColumn',
            
            'buttons'=>array(
                
                'update'=>array(
                     'visible'=>'!empty($data["url"])'
                ),
                'delete'=>array(
                     'visible'=>'!empty($data["url"])'
                ),
               
                'view'=>array(
                     'visible'=>'!empty($data["url"])'
                ),
               
                ///!in_array($data["url"], array("", "h_menu", "v_menu"))
                
            )
        ),
    ),
));
?>
