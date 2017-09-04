<?php if ($rgen['prdpg_price_status']) { ?>
<div class="buying-info1">
	<?php 
	/* PRICE DATA
	**************************/
	if ($price) { ?>
		<div class="price">
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
		</div>
		<?php 
		/* Points */
		if ($points) { ?>
		<span class="reward" style="color: #ff8164"><?php echo $text_points; ?> <?php echo $points; ?></span>
		<?php } ?>
		<br><a id="follow" style="color: #fff;font-size: 16px;text-decoration:none;background:  #ff8164;padding: 1px 6px;border-radius: 5px;">追蹤商品到我的網站</a>

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
<script type="text/javascript">
  $("#follow").on("click", function(){
    var user   = "<?php echo $user;?>";
    var store  = "<?php echo $vendor_name;?>";
    var product_id  = "<?php echo $product_id;?>";
    var product_title = "<?php echo $heading_title;?>";
    if(user != ""){
      $.ajax({
            type: "POST",
            dataType: "html",
            data: {
              user: user,
              store: store,
              product_id: product_id,
              product_title: product_title
            },
            success: function(data){
              alert(data);
            }
          })
    }else{
      alert('請先登入!');
    }
    
  })
</script>