<?php
/* @var $this PagesController */
/* @var $model Pages */
/* @var $form CActiveForm */
?>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/ckeditor/ckeditor.js"></script>


<?php
$this->widget('application.widgets.datepicker.DatePicker');
?>

<div class="form">
<?php echo Yii::t('interface', 'Sunday');?>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'pages-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
            ));
    ?>

    <p class="note"><?php echo Yii::t('interface', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('interface', 'are required.'); ?> </p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($tree, 'level'); ?>
        <?php echo $form->dropDownList($tree, 'level', $treeList, array('name' => 'Tree[tree]', 'options' => $treeSelected)); ?>
        <?php echo $form->error($tree, 'level'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->hiddenField($tree, 'controller', array('value' => 'page')); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'pic'); ?>
        
        <?php if (is_file($_SERVER['DOCUMENT_ROOT'].$img['small']['path'].$model->pic)):?>
            <img src="<?php echo $img['small']['path'].$model->pic?>" /> <br />
            <a href="/admin/<?php echo Yii::app()->controller->id?>/dellpic/id/<?php echo $model->id;?>" onclick="return confirm('<?php echo Yii::t('form', 'Remove this image?');?>');">
            <?php echo Yii::t('form', 'Delete picture');?>
            </a>
        <?php endif;?>
        
        <?php echo $form->fileField($model, 'pic'); ?>
        <?php echo $form->error($model, 'pic'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php echo $form->textField($model, 'date', array('id'=>'datepicker')); ?>
        <?php echo $form->error($model, 'date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'url'); ?>
        <?php echo $form->textField($model, 'url', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'header'); ?>
        <?php echo $form->textField($model, 'header', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'header'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'keywords'); ?>
        <?php echo $form->textField($model, 'keywords', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'keywords'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'isShow'); ?>
        <?php echo $form->CheckBox($model, 'isShow'); ?>
        <?php echo $form->error($model, 'isShow'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'preview'); ?>
        <?php echo $form->textArea($model, 'preview', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
        <?php echo $form->error($model, 'preview'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'body'); ?>
        <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50, 'class' => 'ckeditor')); ?>
        <?php echo $form->error($model, 'body'); ?>
    </div>

   <div class="row">
        <?php echo $form->labelEx($model, 'onMainList'); ?>
        <?php echo $form->CheckBox($model, 'onMainList'); ?>
        <?php echo $form->error($model, 'onMainList'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'isTopOnMain'); ?>
        <?php echo $form->CheckBox($model, 'isTopOnMain'); ?>
        <?php echo $form->error($model, 'isTopOnMain'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'isTopOnSections'); ?>
        <?php echo $form->CheckBox($model, 'isTopOnSections'); ?>
        <?php echo $form->error($model, 'isTopOnSections'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->