

<?php if (!empty($mainNews)): ?>
    <div class="wrapper">
        <?php foreach ($mainNews as $news): ?>
            <?php if ($news->isTopOnMain == '1'): ?>
                <?php if (!isset($topMainTitleNews)): ?>
                    <h3>Топ новости</h3>
                    <?php $topMainTitleNews = ''; ?>
                <?php endif; ?>

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
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="wrapper">
        <?php foreach ($mainNews as $news): ?>
            <?php if ($news->onMainList == '1'): ?>
                <?php if (!isset($onMainListNews)): ?>
                    <h3>Последние новости</h3>
                    <?php $onMainListNews = ''; ?>
                <?php endif; ?>
                <div class="col-1">
                    <div class="box1">
                        <?php if (is_file(Yii::app()->params['webroot'] . '/img/news/small/' . $news->pic)): ?>
                            <a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" title="<?php echo $news->header; ?>">
                                <img src="<?php echo '/img/news/small/' . $news->pic; ?>" alt="<?php echo $news->header; ?>" align="left" style="margin-right: 10px;"/>
                            </a>
                        <?php endif; ?>
                        <h4><?php echo $news->header; ?></h4>
                        <p class="p1"><?php echo $news->preview; ?></p>
                        <div class="wrapper"><a href="/news/<?php echo $news->url; ?>" title="<?php echo $news->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($mainPages)): ?>


    <div class="wrapper">
        <?php foreach ($mainPages as $page): ?>
            <?php if ($page->isTopOnMain == '1'): ?>
                <?php if (!isset($topMainTitle)): ?>
                    <h3>Топ статей</h3>
                    <?php $topMainTitle = ''; ?>
                <?php endif; ?>

                <div class="col-1 main">
                    <div class="box1">
                        <?php if (is_file(Yii::app()->params['webroot'] . '/img/pages/small/' . $page->pic)): ?>
                            <a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" title="<?php echo $page->header; ?>">
                                <img src="<?php echo '/img/pages/small/' . $page->pic; ?>" alt="<?php echo $page->header; ?>" class="img" align="left"/>
                            </a>
                        <?php endif; ?>
                        <h4><?php echo $page->header; ?></h4>
                        <p class="p1"><?php echo $page->preview; ?></p>
                        <div class="wrapper"><a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="wrapper">
        <?php foreach ($mainPages as $page): ?>
            <?php if ($page->onMainList == '1'): ?>
                <?php if (!isset($onMainList)): ?>
                    <h3>Последние статьи</h3>
                    <?php $onMainList = ''; ?>
                <?php endif; ?>
                <div class="col-1">
                    <div class="box1">
                        <?php if (is_file(Yii::app()->params['webroot'] . '/img/pages/small/' . $page->pic)): ?>
                            <a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" title="<?php echo $page->header; ?>">
                                <img src="<?php echo '/img/pages/small/' . $page->pic; ?>" alt="<?php echo $page->header; ?>" align="left" style="margin-right: 10px;"/>
                            </a>
                        <?php endif; ?>
                        <h4><?php echo $page->header; ?></h4>
                        <p class="p1"><?php echo $page->preview; ?></p>
                        <div class="wrapper"><a href="/page/<?php echo $page->url; ?>" title="<?php echo $page->header; ?>" class="link1"><em><b><?php echo Yii::t('interface', 'Read Mode'); ?></b></em></a></div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


<h1><?php echo $this->header; ?></h1>
<?php foreach ($mainPages as $page): ?>

    <?php if ($page->isMainPage == '1'): ?>
        <?php echo $page->body; ?>
    <?php endif; ?>

<?php endforeach; ?>
