<?php
/* @var $this treeController */
/* @var $model tree */
/* @var $form CActiveForm */
?>

<div class="form">

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'tree-form',
    'enableAjaxValidation' => false,
        ));
?>
    <?php echo Yii::t('interface', '<p class="note">Fields with <span class="required">*</span> are required.</p>'); ?>
    

    <?php echo $form->errorSummary($model); ?>




    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'controller'); ?>
        <?php echo $form->dropDownList($model, 'controller', $modules->getHtml()); ?>
        <?php echo $form->error($model, 'controller'); ?>
    </div>




    <div class="row">
        
        
        <?php if ($this->action->id == 'update' && $parent == 'Vertical menu' && $isHorisontalMenu): ?>
          	
            <?php echo $form->labelEx($model, 'isHorisontalEdit'); ?>
            <?php echo CHtml::checkBox('Tree[isHorisontalMenu]', array('checked'=> (isset($parent) && $parent == 'Horisontal menu'))); ?>
        <?php elseif ($this->action->id == 'create'):?>
             <?php echo $form->labelEx($model, 'isHorisontal'); ?>
            <?php echo CHtml::checkBox('Tree[isHorisontalMenu]', array('checked'=> (isset($parent) && $parent == 'Horisontal menu'))); ?>
        <?php endif; ?>
    </div>
    
    <div class="row">
        
        
        <?php if ($this->action->id == 'update' && $parent == 'Horisontal menu' && $isHorisontalMenu): ?>
          	
            <?php echo $form->labelEx($model, 'isVerticalEdit'); ?>
            <?php echo CHtml::checkBox('Tree[isVerticalMenu]', array('checked'=> (isset($parent) && $parent == 'Vertical menu'))); ?>
        <?php elseif ($this->action->id == 'create'):?>
             <?php echo $form->labelEx($model, 'isVertical'); ?>
            <?php echo CHtml::checkBox('Tree[isVerticalMenu]', array('checked'=> (isset($parent) && $parent == 'Vertical menu'))); ?>
        <?php endif; ?>
    </div>

    <div class="row buttons">
       <?php echo CHtml::submitButton($model->isNewRecord ? Yii::t('form', 'Create') : Yii::t('form', 'Save')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->