<link href="catalog/view/theme/default/stylesheet/mvd_list.css" rel="stylesheet">
<div class="vendor-block">
    <h3><?php echo $heading_title; ?></h3>
    <div class="row product-layout list-unstyled">
	  <?php foreach ($banners as $banner) { ?>
	  <article class="vendor-item col-xs-6 col-sm-6 col-md-3" style="padding:10px">
        <a href="<?php echo $banner['link']; ?>" title="<?php echo $banner['title']; ?>" class="vendor-thumb">
        <div><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" class="img-responsive" style="margin:auto;padding:15px;border-radius:50%" ></div>
            <div>
			<div class="caption">
                <span style="font-size:90%;color:#666;line-height:0"><?php echo $banner['title']; ?></span>
				<br/><span style="font-size:80%;color:#666;line-height:0"><?php echo $banner['review']; ?></span>
                <?php if ($review) { ?>
				<div class="rating">
				   <?php for ($i = 1; $i <= 5; $i++) { ?>
					   <?php if ($banner['rating'] < $i) { ?>
					   <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
				   <?php } else { ?>
					   <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
					   <?php } ?>
				   <?php } ?>
				</div>
				<?php } ?>
            </div>
			</div>
        </a>
        </article>
		<?php } ?>

		<article class="vendor-item col-xs-6 col-sm-6 col-md-3" style="padding:10px">
			<button type="button" onClick="parent.location='<?php echo $more_vendors_link; ?>'" class="btn btn-primary btn-lg btn-block"><?php echo $button_more_vendors; ?></button>
		</article>
    </div>
</div>