<div class="buying-info">
	<?php if ($rgen['prdpg_price_status']) { ?>
	<div class="price-wrp">
		<?php 
		/* PRICE DATA
		**************************/
		if ($price) { ?>
		<div class="price vm">
			<b>
				<?php 
				/* Price */
				if (!$special) { ?>
				<span class="price-new"><?php echo $price; ?></span>
				<?php } else { ?>
				<span class="price-old"><?php echo $price; ?></span>
				<span class="price-new price-spl"><?php echo $special; ?></span>
				<?php } ?>

				<?php 
				/* TAX */
				if ($rgen['prdpg_tax_status']) {
				if ($tax) { ?>
				<span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span>
				<?php } } ?>
			</b>
		</div>
			<?php 
			/* Points */
			if ($points) { ?>
			<span class="reward" style="color: #ff8164"><?php echo $text_points; ?> <?php echo $points; ?></span>
			<?php } ?>

			<?php
			/* Discount */
			if ($discounts) { ?>
			<ul class="discount ul-reset">
				<?php foreach ($discounts as $discount) { ?>
				<li><?php echo $discount['quantity']; ?><?php echo $text_discount; ?><?php echo $discount['price']; ?></li>
				<?php } ?>
			</ul>
			<?php } ?>
		<?php } ?>
	</div>
	<?php } ?>

	<?php 
	/* PRODUCT QUANTITY BOX
	**************************/ ?>
	<?php if ($rgen['prdpg_cart_status'] || $rgen['prdpg_wishlist_status'] || $rgen['prdpg_compare_status']) { ?>
	<div class="buy-btn-wrp">
		<?php if ($rgen['prdpg_cart_status']) { ?>
		<label class="control-label" for="input-quantity"><?php echo $entry_qty; ?></label>
		<div class="control-qty">
			<a class="qty-handle" onclick="qtyMinus();"><i class="fa fa-minus-circle"></i></a>
			<input type="text" name="quantity" value="<?php echo $minimum; ?>" size="2" id="input-quantity" class="form-control" />
			<a class="qty-handle" onclick="qtyPlus();"><i class="fa fa-plus-circle"></i></a>
			<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
		</div>
		
		<?php if ($rgen['prdpg_stock_status']) { ?>
		<?php if (isset($prd_quantity) && $prd_quantity < 1) { ?>
		<button type="button" disabled class="btn disable btn-cart<?php echo $carttxt; ?>"><i class="<?php echo $cart_ico; ?>"></i><?php echo $button_cart; ?></button>
		<?php } else { ?>
		<button type="button" class="btn btn-cart<?php echo $carttxt; ?>" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" ><i class="<?php echo $cart_ico; ?>"></i><?php echo $button_cart; ?></button>
		<?php } ?>
		<?php } else { ?>
		<button type="button" class="btn btn-cart<?php echo $carttxt; ?>" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" ><i class="<?php echo $cart_ico; ?>"></i><?php echo $button_cart; ?></button>
		<?php } ?>

		<?php } ?>
		
		<div class="cart-option">
			<?php if ($rgen['prdpg_wishlist_status']) { ?>
			<a onclick="wishlist.add('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a>
			<?php } ?>
			
			<?php if ($rgen['prdpg_compare_status']) { ?>
			<a onclick="compare.add('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a>	
			<?php } ?>
		</div>
	</div>
	<?php } ?>

	<?php if ($minimum > 1) { ?>
	<div class="min-qty"><?php echo $text_minimum; ?></div>
	<?php } ?>
</div>