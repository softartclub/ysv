<?php if (!empty($topItems)): ?>

    <?php foreach ($topItems as $item): ?>
        <div style="margin-top: 10px;">
            <b><?php echo $item->pages->header; ?></b> | <?php echo $item->pages->date; ?>
            <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/small/' . $item->news->pic)): ?>
                <img src="/img/news/small/<?php echo $item->news->pic; ?>" alt="<?php echo $item->news->name; ?>" align="left" />
            <?php endif; ?>
            <?php echo $item->pages->preview; ?>
        </div>

    <?php endforeach; ?>
    <hr>
<?php endif; ?>
 <h1><?php echo $news->header;?></h1>   
<?php echo $news->preview; ?>
<?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/big/' . $news->pic)): ?>
    <img src="/img/news/big/<?php echo $news->pic; ?>" alt="<?php echo $news->name; ?>"/>
<?php endif; ?>

<?php echo $news->body; ?>
<hr>
<?php if (!empty($subItems)): ?>
    <?php foreach ($subItems as $item): ?>

        <div style="margin-top: 10px;">
            <b><?php echo $item->news->header; ?></b>
            <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/small/' . $item->news->pic)): ?>
                <img src="/img/news/small/<?php echo $item->news->pic; ?>" alt="<?php echo $item->news->name; ?>" align="left" />
            <?php endif; ?>
            <?php echo $item->news->preview; ?>
        </div>

    <?php endforeach; ?>

    <?php
    $this->widget('CLinkPager', array(
        'pages' => $paggination
    ))
    ?>
<?php endif; ?>

