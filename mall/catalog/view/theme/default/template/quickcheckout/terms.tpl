<div id="payment" class="text-left" style="display:none;"></div>
<div class="terms">
  <label><?php if ($text_agree) { ?>
    <?php echo $text_agree; ?>
    <input type="checkbox" name="agree" value="1" />
  <?php } ?></label>
  &nbsp;&nbsp;<button type="button" id="button-payment-method" class="btn btn-primary" data-loading-text="<?php echo $text_loading; ?>"><?php echo $button_continue; ?></button>
</div>