<?php
/* @var $this PagesController */
/* @var $data Pages */
?>




<div class="view">

    <div style="float:left;">
       
        <?php echo CHtml::link(Yii::t('interface', 'Update'), array('update', 'id'=>$data->id) ); ?> | 
        <?php echo CHtml::link(Yii::t('interface', 'Delete'), '#', array('submit'=>array('delete','id'=>$data->id),'confirm'=>Yii::t('interface', 'Are you sure you want to delete this item?')) ); ?> 
    
        <br />
        <br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'id'=>$data->id) ); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
        <?php echo CHtml::encode($data->url); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('header')); ?>:</b>
        <?php echo CHtml::encode($data->header); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
        <?php echo CHtml::encode($data->title); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('keywords')); ?>:</b>
        <?php echo CHtml::encode($data->keywords); ?>
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
        <?php echo CHtml::encode($data->date); ?>
        <br />
        <b><?php echo CHtml::encode($data->getAttributeLabel('author')); ?>:</b>
        <?php echo Yii::app()->user->getName()." (". Yii::app()->user->getUserGroupById($data["author"]).")"; ?>
        <br />
    </div>

    <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/small/' . $data->pic)): ?>
        <div style="float: right; border: 1px solid;">
             <?php echo CHtml::image('/img/news/small/' . $data->pic, $data->name); ?>
        </div>
    <?php endif; ?>

    <div style="clear: both;"></div>
    <div>
        <b><?php echo CHtml::encode($data->getAttributeLabel('preview')); ?>:</b>

        <?php echo CHtml::decode($data->preview); ?>
    </div>

</div>
