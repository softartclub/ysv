<?php if (!empty($topItems)): ?>

    <?php foreach ($topItems as $item): ?>
        <div style="margin-top: 10px;">
             <b><?php echo CHtml::link($item->news->name, array('/news/'.$item->news->url));?>  </b> | <?php echo $item->news->date; ?>
          
            <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/small/' . $item->news->pic)): ?>
                 <?php echo CHtml::link(CHtml::image("/img/news/small/".$item->news->pic, $item->news->name, array('align'=>'left') ), array('/news/'.$item->news->url), array('title'=>$item->name));?>
           
            <?php endif; ?>
            <?php echo $item->news->preview; ?>
        </div>

    <?php endforeach; ?>
    <hr>
<?php endif; ?>
 <h1><?php echo $news->header;?></h1>   
<?php echo $news->preview; ?>
<?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/big/' . $news->pic)): ?>
     <?php echo CHtml::image("/img/news/big/".$news->pic, $news->name );?>
           
<?php endif; ?>

<?php echo $news->body; ?>
<hr>
<?php if (!empty($subItems)): ?>
    <?php foreach ($subItems as $item): ?>

        <div style="margin-top: 10px;">
            <b><?php echo CHtml::link($item->news->header, array('/news/'.$item->news->url));?>  </b> | <?php echo $item->news->date; ?>
            <?php if (is_file($_SERVER['DOCUMENT_ROOT'] . '/img/news/small/' . $item->news->pic)): ?>
                <?php echo CHtml::link(CHtml::image("/img/news/small/".$item->news->pic, $item->news->name, array('align'=>'left') ), array('/news/'.$item->news->url), array('title'=>$item->name));?>
             
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

