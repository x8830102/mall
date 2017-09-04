<div id="mvd_carousel<?php echo $module; ?>" class="owl-carousel" style="box-shadow:none;webkit-box-shadow:none">
  <?php foreach ($banners as $banner) { ?>
  <div class="item text-center">
    <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" class="img-responsive" style="margin:0 auto;border-radius:50%"/></a>
	<span style="font-size:80%;color:#666;line-height:0"><?php echo $banner['title']; ?></span>
	<br/><span style="font-size:80%;color:#666;line-height:0"><?php echo $banner['review']; ?></span>
	<br/>
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
  <?php } ?>
</div>
<script type="text/javascript"><!--
$('#mvd_carousel<?php echo $module; ?>').owlCarousel({
	items: 4,
	autoPlay: 3000,
	navigation: true,
	navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
	pagination: true
});
--></script>