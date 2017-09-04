<?php if ($error_warning) { ?>
<div class="alert alert-danger"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($payment_methods) { ?>
<p><?php echo $text_payment_method; ?></p>
<?php if ($payment) { ?>
<table class="table table-hover table-striped">
  <?php foreach ($payment_methods as $payment_method) { ?>
  <tr>
    <td><?php if ($payment_method['code'] == $code) { ?>
      <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" checked="checked" />
      <?php } else { ?>
      <input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" id="<?php echo $payment_method['code']; ?>" />
      <?php } ?></td>
    <td><label for="<?php echo $payment_method['code']; ?>"><?php echo $payment_method['title']; ?></label></td>
	<?php if (!empty($payment_logo[$payment_method['code']])) { ?>
	<td><img src="<?php echo $payment_logo[$payment_method['code']]; ?>" alt="<?php echo $payment_method['title']; ?>" height="20" /></td>
	<?php } else { ?>
	<td></td>
	<?php } ?>
  </tr>
  <?php } ?>
</table>
<?php } else { ?>
  <select name="payment_method" class="form-control">
  <?php foreach ($payment_methods as $payment_method) { ?>
	<?php if ($payment_method['code'] == $code) { ?>
      <option value="<?php echo $payment_method['code']; ?>" selected="selected">
      <?php } else { ?>
      <option value="<?php echo $payment_method['code']; ?>">
      <?php } ?>
    <?php echo $payment_method['title']; ?></option>
  <?php } ?>
  </select><br />
<?php } ?>
<br />
<?php } ?>

<script type="text/javascript"><!--
$('#payment-method input[name=\'payment_method\'], #payment-method select[name=\'payment_method\']').on('change', function() {
	<?php if (!$logged) { ?>
		$.ajax({
			url: 'index.php?route=quickcheckout/payment_method/set',
			type: 'post',
			data: $('#payment-address input[type=\'text\'], #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select, #payment-method input[type=\'text\'], #payment-method input[type=\'checkbox\']:checked, #payment-method input[type=\'radio\']:checked, #payment-method input[type=\'hidden\'], #payment-method select, #payment-method textarea'),
			dataType: 'html',
			cache: false,
			success: function(html) {
				<?php if ($cart && $payment_reload) { ?>
				loadCart();
				<?php } ?>
			},
			<?php if ($debug) { ?>
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
			<?php } ?>
		});
	<?php } else { ?>
		if ($('#payment-address input[name=\'payment_address\']:checked').val() == 'new') {
			var url = 'index.php?route=quickcheckout/payment_method/set';
			var post_data = $('#payment-address input[type=\'text\'], #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select, #payment-method input[type=\'text\'], #payment-method input[type=\'checkbox\']:checked, #payment-method input[type=\'radio\']:checked, #payment-method input[type=\'hidden\'], #payment-method select, #payment-method textarea');
		} else {
			var url = 'index.php?route=quickcheckout/payment_method/set&address_id=' + $('#payment-address select[name=\'address_id\']').val();
			var post_data = $('#payment-method input[type=\'text\'], #payment-method input[type=\'checkbox\']:checked, #payment-method input[type=\'radio\']:checked, #payment-method input[type=\'hidden\'], #payment-method select, #payment-method textarea');
		}
		
		$.ajax({
			url: url,
			type: 'post',
			data: post_data,
			dataType: 'html',
			cache: false,
			success: function(html) {
				<?php if ($cart && $payment_reload) { ?>
				loadCart();
				<?php } ?>
			},
			<?php if ($debug) { ?>
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
			<?php } ?>
		});
	<?php } ?>
});

<?php if ($payment_reload) { ?>
$(document).ready(function() {
	$('#payment-method input[name=\'payment_method\']:checked, #payment-method select[name=\'payment_method\']').trigger('change');
});
<?php } ?>
//--></script>