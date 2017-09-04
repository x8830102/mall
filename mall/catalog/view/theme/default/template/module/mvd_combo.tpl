<link href="catalog/view/theme/default/stylesheet/mvd_list.css" rel="stylesheet">
<link href="catalog/view/javascript/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<div class="vendor-block">
  <h3><?php echo $heading_title; ?></h3>
    <div class="row product-layout list-unstyled">
	<br/>
	<div class="row">
	<div class="form-group">
        <div class="col-sm-12">
			<select name="vendor" onchange="location = this.value" class="form-control"> 
			  <option value=""><?php echo $text_select; ?></option>
			  <?php foreach ($banners as $banner) { ?>
				<option value="<?php echo $banner['link']; ?>"><?php echo $banner['title']; ?></option>
			  <?php } ?>
			</select>
		</div>
    </div>
	</div>
	<br/>
	</div>
</div>
