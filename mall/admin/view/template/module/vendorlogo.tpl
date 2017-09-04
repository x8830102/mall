<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-featured" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-featured" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-vendor-image"><span data-toggle="tooltip" title="<?php echo $help_vendors_image; ?>"><?php echo $entry_vendors_image; ?></span></label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-4">
                    <input type="text" name="mvd_logo_vw_image" value="<?php if ($mvd_logo_vw_image) { echo $mvd_logo_vw_image; } else { echo '135'; } ?>" id="input-mvd-logo-vw-image" class="form-control" />
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="mvd_logo_vh_image" value="<?php if ($mvd_logo_vh_image) { echo $mvd_logo_vh_image; } else { echo '60'; } ?>" id="input-mvd-logo-vh-image" class="form-control" />
                  </div>
                </div>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-product-image"><span data-toggle="tooltip" title="<?php echo $help_product_image; ?>"><?php echo $entry_product_image; ?></span></label>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-4">
                    <input type="text" name="mvd_logo_pvw_image" value="<?php if ($mvd_logo_pvw_image) { echo $mvd_logo_pvw_image; } else { echo '120'; } ?>" id="input-mvd-logo-pvw-image" class="form-control" />
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="mvd_logo_pvh_image" value="<?php if ($mvd_logo_pvh_image) { echo $mvd_logo_pvh_image; } else { echo '30'; } ?>" id="input-mvd-logo-pvh-image" class="form-control" />
                  </div>
                </div>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_infomation; ?>"><?php echo $entry_infomation; ?></span></label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <?php if ($mvd_logo_vendor_information) { ?>
                  <input type="radio" name="mvd_logo_vendor_information" value="1" checked="checked" />
                  <?php echo $text_yes; ?>
                  <?php } else { ?>
                  <input type="radio" name="mvd_logo_vendor_information" value="1" />
                  <?php echo $text_yes; ?>
                  <?php } ?>
                </label>
                <label class="radio-inline">
                  <?php if (!$mvd_logo_vendor_information) { ?>
                  <input type="radio" name="mvd_logo_vendor_information" value="0" checked="checked" />
                  <?php echo $text_no; ?>
                  <?php } else { ?>
                  <input type="radio" name="mvd_logo_vendor_information" value="0" />
                  <?php echo $text_no; ?>
                  <?php } ?>
                </label>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_review; ?>"><?php echo $entry_review; ?></span></label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <?php if ($mvd_logo_vendor_review) { ?>
                  <input type="radio" name="mvd_logo_vendor_review" value="1" checked="checked" />
                  <?php echo $text_yes; ?>
                  <?php } else { ?>
                  <input type="radio" name="mvd_logo_vendor_review" value="1" />
                  <?php echo $text_yes; ?>
                  <?php } ?>
                </label>
                <label class="radio-inline">
                  <?php if (!$mvd_logo_vendor_review) { ?>
                  <input type="radio" name="mvd_logo_vendor_review" value="0" checked="checked" />
                  <?php echo $text_no; ?>
                  <?php } else { ?>
                  <input type="radio" name="mvd_logo_vendor_review" value="0" />
                  <?php echo $text_no; ?>
                  <?php } ?>
                </label>
              </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-vendor"><span data-toggle="tooltip" title="<?php echo $help_vendor; ?>"><?php echo $entry_vendor; ?></span></label>
            <div class="col-sm-10">
              <input type="text" name="vendor" value="" placeholder="<?php echo $entry_vendor; ?>" id="input-vendor" class="form-control" />
              <div id="selected-vendor" class="well well-sm" style="height: 150px; overflow: auto;">
                <?php foreach ($selected_vendor as $vendor) { ?>
                <div id="selected-vendor<?php echo $vendor['vendor_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $vendor['name']; ?>
                  <input type="hidden" name="mvd_logo_vendors_selected[]" value="<?php echo $vendor['vendor_id']; ?>" />
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('input[name=\'vendor\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=module/vendorlogo/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['vendor_id']
					}
				}));
			}
		});
	},
	select: function(item) {
		$('input[name=\'vendor\']').val('');
		
		$('#selected-vendor' + item['value']).remove();
		
		$('#selected-vendor').append('<div id="selected-vendor' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="mvd_logo_vendors_selected[]" value="' + item['value'] + '" /></div>');	
	}
});
	
$('#selected-vendor').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script></div>
<?php echo $footer; ?>