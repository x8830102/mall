<link href="catalog/view/theme/default/stylesheet/mvd_list.css" rel="stylesheet">
<div class="vendor-block">
    <h3><?php echo $heading_title; ?></h3>
    <div class="row product-layout list-unstyled">
    <?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
	  <article class="vendor-item col-xs-12 col-sm-6 col-md-3" style="padding:5px;text-align:center">
		<div class="col-sm-5"><div id="shop_search" class="input-group">
		  <input type="text" name="shop_search" value="" placeholder="Search" class="form-control" style="width:155px;height:39px;padding: 0 10px;border-radius: 6px;border-top-right-radius: 0;border-bottom-right-radius: 0;">
		  <span class="input-group-btn">
			<button type="button" id="shop-search" class="btn btn-default" style="padding:10px 14px;"><i class="fa fa-search"></i></button>
		  </span>
		</div>
        </article>
    </div>
</div>
<script type="text/javascript"><!--
/* Shop Search */
$('#shop-search').on('click', function() {
	var url = 'index.php?route=module/vendorlogo/visitstore&vendor_id=<?php echo $vendor_id; ?>';
	
	var value = $('input[name=\'shop_search\']').val();

	if (value) {
		url += '&shop_search=' + encodeURIComponent(value);
	}
	
	location = url;
});

$('#shop_search input[name=\'shop_search\']').on('keydown', function(e) {
	if (e.keyCode == 13) {
		$('input[name=\'shop_search\']').parent().find('button').trigger('click');
	}
});
//--></script>