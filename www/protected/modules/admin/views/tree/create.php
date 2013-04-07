<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs = array(
    Yii::t('interface', $this->module->id) => '/admin',
    Yii::t('interface', 'Tree') => array('index'),
    Yii::t('interface', 'Create'),
);

$this->menu = array(
    array('label' => Yii::t('interface', 'List tree'), 'url' => array('index')),
    array('label' => Yii::t('interface', 'Manage trees'), 'url' => array('admin')),
);
?>

<h1>Create Menu</h1>

<?php echo $this->renderPartial('_form', array('model' => $model, 'modules' => $modules)); ?>