<?php
/* @var $this PageController */

$this->breadcrumbs = array(
    Yii::t('form', 'News'),
);
?>


<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php if ($newsList): ?>
    <?php foreach ($newsList as $news): ?>
        <div class="col-1 main">
            <div class="box1">
                <?php if (is_file(Yii::app()->params['webroot'] . '/img/news/small/' . $news->pic)): ?>
                    <a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" title="<?php echo $news->header; ?>">
                        <img src="<?php echo '/img/news/small/' . $news->pic; ?>" alt="<?php echo $news->header; ?>" class="img" align="left"/>
                    </a>
                <?php endif; ?>
                <h4><?php echo $news->header; ?></h4>
                <p class="p1"><?php echo $news->preview; ?></p>
                <div class="wrapper"><a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
