<div class="cl info-wrp">
	<div class="name">
		<h2 class="h2"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h2>
		<?php if ($block['cat_status']) { ?>
		<?php if (isset($product['cat_info']) && sizeof($product['cat_info']) > 0) { ?>
		<p class="prd-cats">
			<?php echo $lng_data['text_category'] . ' : '; ?>
			<?php foreach ($product['cat_info'] as $cat) { ?>
			<a href="<?php echo $cat['url']; ?>"><?php echo $cat['name']; ?></a> 
			<?php } ?>
		</p>
		<?php } } ?>
	</div>
	
	<?php if ($product['price'] || $block['rating_status']) { ?>
	<div class="price-wrp">
		<?php if ($product['price']) { ?>
			<div class="price">
				<?php if (!$product['special']) { ?>
				<span class="price-new"><?php echo $product['price']; ?></span>
				<?php } else { ?>
				<span class="price-old"><?php echo $product['price']; ?></span>
				<span class="price-new price-spl"><?php echo $product['special']; ?></span>
				<?php } ?>
			</div>

			<?php if ($product['special']) { ?>
			<span class="discount-tag"><?php echo $this->rgen('factory')->discount($product['price'], $product['special']); ?></span>
			<?php } ?>
		<?php } ?>

		<?php if ($block['rating_status'] && $product['rating']) { ?>
		<div class="review-stars">
			<?php for ($rating = 1; $rating <= 5; $rating++) { ?>
			<?php if ($product['rating'] < $rating) { ?>
			<i class="fa fa-star-o"></i>
			<?php } else { ?>
			<i class="fa fa-star"></i>
			<?php } ?>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<?php } ?>

	<?php if (isset($product['end_date'])) { ?>
	<?php if ($product['end_date']) { ?>
	<div class="countdown"></div>
	<?php } ?>
	<?php } ?>
	
	<?php if ($block['description_status'] && isset($product['description'])) { ?>
	<div class="description"><?php echo $product['description']; ?></div>
	<?php } ?>
	<style>
		@media (max-width: 767px) {
			.visible-xs { display: inline!important; }
		}
	</style>
	<?php if ($block['cart_status'] || $block['wishlist_status'] || $block['compare_status']) { ?>
	<?php $btn = $block['btn_text'] ? $block['btn_text'][$lng] : $button_cart; ?>
	<div class="button-group">
		<?php if ($block['cart_status']) { ?>
		<a  title="<?php echo $btn; ?>" ><button type="button" onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo isset($product['minimum']) ? $product['minimum'] : 1; ?>');"><i class="fa fa-shopping-cart"></i> <span class="visible-xs hidden-sm hidden-md" ><?php echo $button_cart; ?></span></button></a>

		<a class="vm btn btn-cart grid-on list-on normal-on" style="padding: 8px;background: rgb(167, 144, 116);border:0px;border-radius: 6px;color: #fff;margin-bottom: 6px;font-size: 16px" data-toggle="tooltip"  onclick="cart.add('<?php echo $product['product_id']; ?>', '<?php echo isset($product['minimum']) ? $product['minimum'] : 1; ?>','1');">結帳</a>

		<?php } ?>
		
		<?php if ($block['wishlist_status'] || $block['compare_status']) { ?>
	
			<?php if ($block['wishlist_status']) { ?>
			<a title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');" title="加到願望清單" style="padding: 8px;background: rgb(167, 144, 116);border:0px;border-radius: 6px;color: #fff;margin-bottom: 6px;font-size: 16px"><i class="fa fa-heart"></i></a>	
			<?php } ?>
			
			<?php if ($block['compare_status']) { ?>
			<a title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');" title="加入比較" style="padding: 8px;background: rgb(167, 144, 116);border:0px;border-radius: 6px;color: #fff;margin-bottom: 6px;font-size: 16px"><i class="fa fa-exchange"></i></a>
			<?php } ?>
		
		<?php } ?>
	</div>
	<?php } ?>

</div>