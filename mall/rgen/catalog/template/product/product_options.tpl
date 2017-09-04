<?php 
if ($prdpg == 1 || $prdpg == 2) {?>
<style>
	li,span { font-size: 16px!important }
	.review-links a { font-size: 14px }
</style>
	<ul class="ul-reset item-info">
		<?php if ($manufacturer) { ?>
		<li><span><!--<?php echo $text_manufacturer; ?>-->商品型號：</span> <a href="<?php echo $manufacturers; ?>"><?php echo $manufacturer; ?></a></li>
		<?php } ?>
		<li><span><!--<?php echo $text_model; ?>-->商品型號：</span> <?php echo $model; ?></li>

		<?php if ($vendor_data) { 
			$str = strrev($visit_store);
			$str = explode("/",$str);
			$vendor_username = strrev($str[0]);
			$pdo_cmg = new PDO("mysql:host=localhost;dbname=cmg58891_a;charset=utf8","cmg58891","rgn26842");
			$stmt = $pdo_cmg->query("SELECT a_pud FROM memberdata WHERE m_username = '$vendor_username'");
			$check = $stmt->fetch();
			if($check['a_pud'] >= 4 || $check['a_pud'] == 0){
				$vendor_web = 'http://'.$vendor_username.'.lifelink.com.tw';
			}else{
				$vendor_web = 'http://'.$vendor_username.'.lifelink.cc';
			}
			?>
			<!--<li><a href="<?php echo $visit_store; ?>"><img src="<?php echo $vendor_image ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" style="border-radius:50%" /></a></li>-->
			<li style="color: #ff8164"><!--<?php echo $text_visit_store; ?>--> <span style="color: #ff8164" >販售店家：</span> <a href="<?php echo $visit_store; ?>"  style="color: #fff;font-size: 16px;text-decoration:none;background:  #ff8164;padding: 1px 6px;border-radius: 5px"><?php echo $vendor_name; ?></a> <a href="<?php echo $vendor_web; ?>"  style="color: #fff;font-size: 16px;text-decoration:none;background:  #ff8164;padding: 1px 6px;border-radius: 5px">官方網站</a></li>
			<?php if ($vendor_rating) { ?>
			<li>
			  <div class="rating">
				<?php for ($i = 1; $i <= 5; $i++) { ?>
				<?php if ($vendor_rating < $i) { ?>
				<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
				<?php } else { ?>
				<span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
				<?php } ?>
				<?php } ?>
			  </div>
			</li>
		<?php } ?>
		<?php if ($transactions) { ?>
			<li style="font-size:90%;color:#999"><!--<?php echo $text_transaction; ?>--> <span>已銷售：</span> <?php echo $transactions; ?></li>
		<?php } ?>
		<?php } ?>

		<?php if ($reward) { ?>
		<li><span><!--<?php echo $text_reward; ?>-->庫存狀況：</span> <?php echo $reward; ?></li>
		<?php } ?>
		<li><span><!--<?php echo $text_stock; ?>-->庫存狀況：</span> <?php echo $stock; ?></li>
	</ul>

	<?php 
	/* PLACE - BELOW INFORMATION
	**************************/ ?>
	<?php echo isset($pdpg_binfo) ? $pdpg_binfo : null; ?>

	<?php 
	/* REIVEW
	**************************/ ?>
	<?php if ($rgen['prdpg_rating_status']) { ?>
	<?php if ($review_status) { ?>
	<div class="rating-wrp">
		<span class="review-stars large" data-toggle="tooltip" title="<?php echo '('.$reviews.')'; ?>">
			<?php for ($i = 1; $i <= 5; $i++) { ?>
			<?php if ($rating < $i) { ?>
			<i class="fa fa-star-o"></i>
			<?php } else { ?>
			<i class="fa fa-star"></i>
			<?php } ?>
			<?php } ?>	
		</span>
		<span class="review-links">
			<a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $reviews; ?></a><br>
			<a href="" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><?php echo $text_write; ?></a>	
		</span>
	</div>
	<?php } ?>
	<?php } ?>

<?php } ?>

<?php 
/* PLACE - ABOVE OPTIONS
**************************/ ?>
<?php echo isset($pdpg_toption) ? $pdpg_toption : null; ?>
<?php 
/* PRODUCT OPTIONS
**************************/
if ($rgen['prdpg_options_status']) { include $this->rgen('prd_option_fields'); } ?>

<?php 
/* PLACE - BELOW OPTIONS
**************************/ ?>
<?php echo isset($pdpg_boption) ? $pdpg_boption : null; ?>

<?php 
if ($prdpg == 2 || $prdpg == 3) {
/* PRODUCT QUANTITY BOX
**************************/ ?>
<div class="buy-btn-wrp1">
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
	<button type="button" disabled class="btn disable btn-cart<?php echo $carttxt; ?>"><i class="<?php echo $cart_ico; ?>"></i><span class="hidden-xs"><?php echo $button_cart; ?></span></button>
	<?php } else { ?>
	<button type="button" class="btn btn-cart<?php echo $carttxt; ?>" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" ><i class="<?php echo $cart_ico; ?>"></i><span class="hidden-xs"><?php echo $button_cart; ?></span></button>
	<button type="button" id="button-checkout" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-cart<?php echo $carttxt; ?>"><?php global $language; echo ($language->get('button_checkout')) ?></button>
	<?php } ?>
	<?php } else { ?>
	<button type="button" class="btn btn-cart<?php echo $carttxt; ?>" id="button-cart" data-loading-text="<?php echo $text_loading; ?>" ><i class="<?php echo $cart_ico; ?>"></i><span class="hidden-xs"><?php echo $button_cart; ?></span></button>
	<button type="button" id="button-checkout" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-cart<?php echo $carttxt; ?>"><?php global $language; echo ($language->get('button_checkout')) ?></button>
	<?php } ?>

	<?php } ?>
	
	<div class="cart-option" style="background: rgb(167, 144, 116);height: 45px;line-height: 40px;width: 90px;margin-left: 0px">
		<?php if ($rgen['prdpg_wishlist_status']) { ?>
		<a onclick="wishlist.add('<?php echo $product_id; ?>');" title="加到願望清單"><i class="fa fa-heart" style="width: 45px;text-align: center;height: 45px"></i></a>
		<?php } ?>
		<?php if ($rgen['prdpg_compare_status']) { ?>
		<a onclick="compare.add('<?php echo $product_id; ?>');" title="加入比較"><i class="fa fa-exchange" style="width: 30px;text-align: center;height: 45px"></i></a>	
		<?php } ?>
	</div>
	<?php if ($minimum > 1) { ?>
	<div class="min-qty"><?php echo $text_minimum; ?></div>
	<?php } ?>
</div>
<style>
	@media (max-width: 510px){
		/*.cart-option {margin-top: 5px;margin-left: 19%!important}*/

	}
	@media (max-width: 330px){
		.buy-btn-wrp1 .btn-cart { padding: 10px 6px }
	}
</style>
<?php 
/* PLACE - BELOW QUANTITY
**************************/ ?>
<?php echo isset($pdpg_bqty) ? $pdpg_bqty : null; ?>

<?php } ?>

<!-- AddThis Button BEGIN -->
<!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5934d11dcedce289"></script> 
<!-- AddThis Button END --> 
