<link href="catalog/view/theme/default/stylesheet/mvd_box.css" rel="stylesheet">
<div class="vendor-block">
    <h3><?php echo $heading_title; ?></h3>
    <div class="row product-layout list-unstyled">
	  <article class="vendor-item col-xs-12 col-sm-6 col-md-3" style="padding:5px;text-align:center">
		<?php if ($year) { ?>
		<span style="font-size:120%;color:#666;line-height:0"><?php echo $year; ?></span>
		<?php } ?>
        <a href="<?php echo $link; ?>" title="<?php echo $title; ?>" class="vendor-thumb">
        <div><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" class="img-responsive" style="margin:auto;padding:15px;border-radius:50%" ></div></a>
			<div><a href="<?php echo $profile_link; ?>" title="<?php echo $text_findme; ?>"><i class="fa fa-map-marker"></i> <?php echo $text_findme; ?></a></div>
			<?php if ($rating) { ?>
                <div class="rating" title="<?php echo $rating . $text_stars; ?>" >
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($rating < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
            <?php } ?>
        </article>
		<?php if ($vl_installed) { ?>
		<article class="vendor-item col-xs-12 col-sm-6 col-md-3" style="padding:5px">
			<button type="button" onClick="parent.location='<?php echo $link; ?>'" class="btn btn-primary btn-lg btn-block"><i class="fa fa-building-o"></i> <?php echo $text_visit_store; ?></button>
		</article>
		<?php } ?>
    </div>
</div>