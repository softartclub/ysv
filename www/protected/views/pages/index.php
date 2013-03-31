<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	Yii::t('interface', 'Pages'),
);
?>
<h1><?php echo Yii::t('interface', 'Pages List'); ?></h1>



<?php if ($pagesList): ?>
    <?php foreach ($pagesList as $pages): ?>
        <div class="col-1 main">
            <div class="box1">
                <?php if (is_file(Yii::app()->params['webroot'] . '/img/pages/small/' . $pages->pic)): ?>
                    <a href="/news/<?php echo $pages->url; ?>" title="<?php echo $pages->header; ?>" title="<?php echo $pages->header; ?>">
                        <img src="<?php echo '/img/pages/small/' . $pages->pic; ?>" alt="<?php echo $pages->header; ?>" class="img" align="left"/>
                    </a>
                <?php endif; ?>
                <h4><?php echo $pages->header; ?></h4>
                <p class="p1"><?php echo $pages->preview; ?></p>
                <div class="wrapper"><a href="/pages/<?php echo $pages->url; ?>" title="<?php echo $pages->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

