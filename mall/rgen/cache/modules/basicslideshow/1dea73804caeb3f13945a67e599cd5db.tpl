
<div id="rgen-basicslideshow-rgenrnfA7t" class="rgen-basicslideshow basicslideshow-rgfTN">
	<div class="slideshow-wrp dots-typ1 win-full-width-ss">
		<div class="slideshow">
						<div class="slide" data-background="http://mall.lifelink.com.tw/image/cache/catalog/homeimg/1060420-2-1800x650.jpg">
							</div>
						<div class="slide" data-background="http://mall.lifelink.com.tw/image/cache/catalog/homeimg/1060420-3-1800x650.jpg">
							</div>
					</div>
	</div>
</div>

<script type="text/javascript" ><!--
$(document).ready(function(){

	
	var win         = $(window);
	var auto        = true;
	var autostopped = false;
	var container   = $("#rgen-basicslideshow-rgenrnfA7t .slideshow-wrp");

	/* Default slide script
	------------------------*/
	var sudoSlider = $("#rgen-basicslideshow-rgenrnfA7t .slideshow").sudoSlider({
		responsive: true,
		controlsAttr: 'class="owl-controls"',
		effect: "slide",
		speed: 1500,
				auto: true,
				pause: 2000,
				prevNext: true,
		nextHtml: '<a class="next"><i class="fa fa-chevron-right"></i></a>',
		prevHtml: '<a class="prev"><i class="fa fa-chevron-left"></i></a>',
						numeric: true,
		numericAttr: 'class="dots ul-reset"',
		
				continuous: true,
				updateBefore: true,
		mouseTouch: false,
		touch: true,
		slideCount: 1
	})

		.mouseenter(function() {
		auto = sudoSlider.getValue('autoAnimation');
		if (auto) { sudoSlider.stopAuto(); } else { autostopped = true; }
	})
	.mouseleave(function() {
		if (!autostopped) { sudoSlider.startAuto(); }
	})
	;

	
	
		bss.onResize("wfw", "650", sudoSlider, container);
	bss.fullSlider(sudoSlider);
	});
//--></script>
