<?php
if (isset($contentslider)) {
	foreach ($contentslider as $key => $value) {
		
		$keyparts = explode('.', $key);
		$contentslider_cls = '.contentslider-'.$keyparts[1];

		/* Large screens
		------------------------*/
		if (isset($value['d'])) {
			contentslider($value['d'], $contentslider_cls);
		}
		
		/* Tablet and Mobile
		------------------------*/
		if ($settings['responsive_status']) {
			echo '@media only screen and (min-width: 768px) and (max-width: 979px) {';
			if (isset($value['t'])) {
				contentslider($value['t'], $contentslider_cls);
			}
			echo '}';

			echo '@media only screen and (min-width: 200px) and (max-width: 767px) {';
			if (isset($value['m'])) {
				contentslider($value['m'], $contentslider_cls);
			}
			echo '}';
		}


		/* Dots
		------------------------*/
		echo isset($value['dots']['wrp']) ? 
		$contentslider_cls.' .owl-dots { '. $value['dots']['wrp'] . ' }' : '';

		echo isset($value['dots']['normal']) ? 
		$contentslider_cls.' .owl-dots .owl-dot span { '. $value['dots']['normal'] . ' }' : '';

		echo isset($value['dots']['active']) ? 
		$contentslider_cls.' .owl-dots .owl-dot.active span { '. $value['dots']['active'] . ' }' : '';

		/* Arrows
		------------------------*/
		echo isset($value['arrows']['wrp']) ? 
		$contentslider_cls.' .owl-nav { '. $value['arrows']['wrp'] . ' }' : '';

		echo isset($value['arrows']['arrow_line']) ? 
		$contentslider_cls.' .ctrl-b .owl-nav:after { '. $value['arrows']['arrow_line'] . ' }' : '';

		echo isset($value['arrows']['arrow']) ? 
		$contentslider_cls.' .owl-nav > div { '. $value['arrows']['arrow'] . ' }' : '';

		echo isset($value['arrows']['arrow_h']) ? 
		$contentslider_cls.' .owl-nav > div:hover { '. $value['arrows']['arrow_h'] . ' }' : '';
		
	}
}
