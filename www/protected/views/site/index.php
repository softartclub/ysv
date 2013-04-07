

<?php if (!empty($mainTopNews)): ?>
    <div class="wrapper">
        <?php foreach ($mainTopNews as $news): ?>
            <b><?php echo Yii::t('interface', 'Top news'); ?></b>
            <div class="col-1 main">
                <div class="box1">
                    <?php if (is_file(Yii::app()->params['webroot'] . '/img/news/small/' . $news->pic)): ?>
                        <a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" title="<?php echo $news->header; ?>">
                            <img src="<?php echo '/img/news/small/' . $news->pic; ?>" alt="<?php echo $news->header; ?>" class="img" align="left"/>
                        </a>
                    <?php endif; ?>
                    <b><?php echo $news->header; ?> | <?php echo $news->date; ?></b>
                    <p class="p1"><?php echo $news->preview; ?></p>
                    <div class="wrapper"><a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

<?php endif; ?>

<?php if (!empty($mainLastNews)): ?>
    <div class="wrapper">
        <?php foreach ($mainLastNews as $news): ?>
            <b><?php echo Yii::t('interface', 'Last news'); ?></b>
            <div class="col-1">
                <div class="box1">
                    <?php if (is_file(Yii::app()->params['webroot'] . '/img/news/small/' . $news->pic)): ?>
                        <a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" title="<?php echo $news->header; ?>">
                            <img src="<?php echo '/img/news/small/' . $news->pic; ?>" alt="<?php echo $news->header; ?>" align="left" style="margin-right: 10px;"/>
                        </a>
                    <?php endif; ?>
                    <b><?php echo $news->header; ?> | <?php echo $news->date; ?></b>
                    <p class="p1"><?php echo $news->preview; ?></p>
                    <div class="wrapper"><a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($mainTopPages)): ?>
    <div class="wrapper">
        <?php foreach ($mainTopPages as $page): ?>
            <b><?php echo Yii::t('interface', 'Top pages'); ?></b>
            <div class="col-1 main">
                <div class="box1">
                    <?php if (is_file(Yii::app()->params['webroot'] . '/img/pages/small/' . $page->pic)): ?>
                        <a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" title="<?php echo $page->header; ?>">
                            <img src="<?php echo '/img/pages/small/' . $page->pic; ?>" alt="<?php echo $page->header; ?>" class="img" align="left"/>
                        </a>
                    <?php endif; ?>
                    <b><?php echo $page->header; ?></b>
                    <p class="p1"><?php echo $page->preview; ?></p>
                    <div class="wrapper"><a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if (!empty($mainLastPages)): ?>
    <div class="wrapper">
        <?php foreach ($mainLastPages as $page): ?>
            <b><?php echo Yii::t('interface', 'Last pages'); ?></b>

            <div class="col-1">
                <div class="box1">
                    <?php if (is_file(Yii::app()->params['webroot'] . '/img/pages/small/' . $page->pic)): ?>
                        <a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" title="<?php echo $page->header; ?>">
                            <img src="<?php echo '/img/pages/small/' . $page->pic; ?>" alt="<?php echo $page->header; ?>" align="left" style="margin-right: 10px;"/>
                        </a>
                    <?php endif; ?>
                    <b><?php echo $page->header; ?></b>
                    <p class="p1"><?php echo $page->preview; ?></p>
                    <div class="wrapper"><a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                </div>
            </div>

        <?php endforeach; ?>
    </div>
<?php endif; ?>


<h1><?php echo $this->header; ?></h1>
<?php foreach ($mainPages as $page): ?>

    <?php if ($page->isMainPage == '1'): ?>
        <?php if (is_file(Yii::app()->params['webroot'] . '/img/pages/big/' . $page->pic)): ?>
            <a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" title="<?php echo $page->header; ?>">
                <img src="<?php echo '/img/pages/big/' . $page->pic; ?>" alt="<?php echo $page->header; ?>" align="left" style="margin-right: 10px;"/>
            </a>
        <?php endif; ?>
        <?php echo $page->body; ?>
    <?php endif; ?>

<?php endforeach; ?>
