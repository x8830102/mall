<?php if ($voucher_module || $coupon_module || $reward_module) { ?>
<div class="onepage-ch-heading" id="coupon-heading"><i class="fa fa-gift"></i> 輸入持有的折扣</div>
<?php if ($coupon_module) { ?>
<div id="coupon-content">
  <div class="input-group">
	<input type="text" name="coupon" value="" class="form-control" placeholder="<?php echo $text_use_coupon; ?>" />
	<span class="input-group-btn">
	  <button type="button" id="button-coupon" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
	</span>
  </div>
</div>
<?php } ?>
<?php if ($voucher_module) { ?>
<div id="voucher-content">
  <div class="input-group">
	<input type="text" name="voucher" value="" class="form-control" placeholder="<?php echo $text_use_voucher; ?>" />
	<span class="input-group-btn">
	  <button type="button" id="button-voucher" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
	</span>
  </div>
</div>
<?php } ?>
<?php if ($reward_module && $reward) { ?>
<div id="reward-content">
  <div class="input-group">
	<input type="number" name="reward" min="0" value="" class="form-control" placeholder="<?php echo $text_use_reward.$points_tpl; ?>" />
	<span class="input-group-btn">
	  <button type="button" id="button-reward" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i></button>
	</span>
  </div>
</div>
<?php } ?>
<?php } ?>

<script type="text/javascript"><!--
$('#coupon-heading').on('click', function() {
    if($('#coupon-content').is(':visible')){
      $('#coupon-content').slideUp('slow');
    } else {
      $('#coupon-content').slideDown('slow');
    };
});

$('#coupon-heading').on('click', function() {
    if($('#voucher-content').is(':visible')){
      $('#voucher-content').slideUp('slow');
    } else {
      $('#voucher-content').slideDown('slow');
    };
});

$('#coupon-heading').on('click', function() {
    if($('#reward-content').is(':visible')){
      $('#reward-content').slideUp('slow');
    } else {
      $('#reward-content').slideDown('slow');
    };
});

$(document).ready(function(){
    if($('#coupon-content').is(':visible')){
      $('#coupon-content').slideUp('slow');
    } else {
      $('#coupon-content').show();
    };

    if($('#voucher-content').is(':visible')){
      $('#voucher-content').slideUp('slow');
    } else {
      $('#voucher-content').show();
    };

    if($('#reward-content').is(':visible')){
      $('#reward-content').slideUp('slow');
    } else {
      $('#reward-content').show();
    };
});
//--></script>