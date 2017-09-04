<?php if (isset($block) && sizeof($block) > 0) { ?>
<div class="ctnsld-block1">
	<?php if (isset($block['title']) && $block['title_status']) { ?>
	<h3 class="hd"><?php echo html_entity_decode($block['title'][$lng], ENT_QUOTES, 'UTF-8'); ?></h3>
	<?php } ?>
	<?php if (isset($block['description']) && $block['description_status']) { ?>
	<div class="info">
		<?php echo html_entity_decode($block['description'][$lng], ENT_QUOTES, 'UTF-8'); ?>
	</div>
	<?php } ?>
</div>
<?php } ?>