<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<div class="span-5 last">
	<div id="sidebar">
	<?php  $this->widget('application.widgets.menu.SiteMenu', array(
            'htmlOptions'=>array( 'class'=>'v_menu_left')
               )); ?>
	</div><!-- sidebar -->
</div>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<?php $this->endContent(); ?>