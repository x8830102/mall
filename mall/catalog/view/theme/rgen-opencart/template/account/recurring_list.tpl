<?php include $this->rgen('layout_top'); ?>

<?php if ($recurrings) { ?>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<td class="text-left"><?php echo $column_recurring_id; ?></td>
				<td class="text-left"><?php echo $column_date_added; ?></td>
				<td class="text-left"><?php echo $column_status; ?></td>
				<td class="text-left"><?php echo $column_product; ?></td>
				<td class="text-right"><?php echo $column_action; ?></td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($recurrings as $recurring) { ?>
			<tr>
				<td class="text-left">#<?php echo $recurring['id']; ?></td>
				<td class="text-left"><?php echo $recurring['date_added']; ?></td>
				<td class="text-left"><?php echo $status_types[$recurring['status']]; ?></td>
				<td class="text-left"><?php echo $recurring['name']; ?></td>
				<td class="text-right"><a href="<?php echo $recurring['href']; ?>"><img src="catalog/view/theme/default/image/info.png" alt="<?php echo $button_view; ?>" title="<?php echo $button_view; ?>" /></a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="text-right"><?php echo $pagination; ?></div>
<?php } else { ?>
<p><?php echo $text_empty; ?></p>
<?php } ?>
<div class="buttons clearfix">
	<div class="pull-right"><a href="<?php echo $continue; ?>" class="default-btn"><?php echo $button_continue; ?></a></div>
</div>

<?php 
	include $this->rgen('layout_bottom');
	echo $footer;
?>
