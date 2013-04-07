<?php if (!empty($topItems)): ?>

    <?php foreach ($topItems as $item): ?>
        <div style="margin-top: 10px;">
             <b><?php echo CHtml::link($item->pages->header, array('/pages/' . $item->pages->url)); ?>  </b> | <?php echo $item->pages->date; ?>
            <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/pages/small/' . $item->pages->pic)): ?>
                <?php echo CHtml::link(CHtml::image("/img/pages/small/" . $item->pages->pic, $item->pages->name, array('align' => 'left')), array('/pages/' . $item->pages->url), array('title' => $item->name)); ?>

            <?php endif; ?>
            <?php echo $item->pages->preview; ?>
        </div>

    <?php endforeach; ?>
    <hr>
<?php endif; ?>
<h1><?php echo $page->header; ?></h1>   
<?php echo $page->preview; ?>
<?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/pages/big/' . $page->pic)): ?>
    <img src="/img/pages/big/<?php echo $page->pic; ?>" alt="<?php echo $page->name; ?>"/>
<?php endif; ?>

<?php echo $page->body; ?>
<hr>
<?php if (!empty($subItems)): ?>
    <?php foreach ($subItems as $item): ?>

        <div style="margin-top: 10px;">

            <b><?php echo CHtml::link($item->pages->header, array('/pages/' . $item->pages->url)); ?>  </b> | <?php echo $item->pages->date; ?>
            <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/pages/small/' . $item->pages->pic)): ?>
                <?php echo CHtml::link(CHtml::image("/img/pages/small/" . $item->pages->pic, $item->pages->name, array('align' => 'left')), array('/pages/' . $item->pages->url), array('title' => $item->name)); ?>

            <?php endif; ?>
            <?php echo $item->pages->preview; ?>
        </div>

    <?php endforeach; ?>

    <?php
    $this->widget('CLinkPager', array(
        'pages' => $paggination
    ))
    ?>
<?php endif; ?>


