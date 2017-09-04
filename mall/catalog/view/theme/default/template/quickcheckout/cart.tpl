<table class="quickcheckout-cart">

		
  

    <?php if ($products || $vouchers) { ?>

        <?php foreach ($products as $product) { ?>
        <tr style="background: #eeeeee;color:#000">
          <td class="image" ><?php echo $text_image; ?></td>
          <td class="name" colspan="2"><?php echo $text_name; ?></td>
        </tr>
        <tr>
          <td class="image" ><?php if ($product['thumb']) { ?>
            <a href="<?php echo $product['href']; ?>"><img style="width: 100%" src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
            <?php } ?></td>
          <td class="name" colspan="2"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
            <div>
              <?php foreach ($product['option'] as $option) { ?>
              <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small><br />
              <?php } ?>
			  <?php if ($product['reward']) { ?>
			  <br />
			  <small><?php echo $product['reward']; ?></small>
			  <?php } ?>
			  <?php if ($product['recurring']) { ?>
			  <br />
			  <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
			  <?php } ?>
            </div></td></tr>
     <tr  style="background: #eeeeee;color:#000">
      <td class="quantity" style="text-align: center;"><?php echo $text_quantity; ?></td>
      <td class="price1" style="text-align: center;"><?php echo $text_price; ?></td>
      <td class="total" style="text-align: center;"><?php echo $text_total; ?></td>
    </tr>
      <tr>
          <td class="quantity"><?php if ($edit_cart) { ?>
		    <div class="input-group btn-block" style="display: inline-block;">
		      <input style="height: 39px;width: 45px" type="text" name="quantity[<?php echo $product['key']; ?>]" size="1" value="<?php echo $product['quantity']; ?>" class="form-control" />
			  <span class="input-group-btn" style="position: absolute;left: 45px">
				<button data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary button-update"><i class="fa fa-refresh"></i></button>
				<button data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger button-remove" data-remove="<?php echo $product['key']; ?>"><i class="fa fa-times-circle"></i></button>
			  </span>
			</div>
			<?php } else { ?>
			x&nbsp;<?php echo $product['quantity']; ?>
			<?php } ?></td>
		  <td class="price1" style="text-align: center;"><?php echo $product['price']; ?></td>
          <td class="total"><?php echo $product['total']; ?></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
    <tr>
        <td class="image"><?php echo $text_image; ?></td>
        <td class="name"  colspan="2"><?php echo $text_name; ?></td>
    </tr>
    <tr>
        <td class="image"></td>
        <td class="name"  colspan="2"><?php echo $voucher['description']; ?></td>
    </tr>
    <tr>
      <td class="quantity"><?php echo $text_quantity; ?></td>
      <td class="price1" style="text-align: center;"><?php echo $text_price; ?></td>
      <td class="total"><?php echo $text_total; ?></td>
    </tr>
    <tr>
      <td class="quantity">x&nbsp;1</td>
		  <td class="price1" style="text-align: center;"><?php echo $voucher['amount']; ?></td>
      <td class="total"><?php echo $voucher['amount']; ?></td>
    </tr>
        <?php } ?>
		<?php foreach ($totals as $total) { ?>
			<tr>
				<td class="text-right" colspan="2"><b><?php echo $total['title']; ?>:</b></td>
				<td class="text-right" ><?php echo $total['text']; ?></td>
			</tr>
        <?php } ?>

    <?php } ?>
</table>

<?php if (!empty($field_comment['display'])) { ?>
    <br /><div class="onepage-ch-heading" id="order-comment" >
    <strong><?php if (!empty($field_comment['required'])) { ?><span class="required">*</span> <?php } ?></strong>
    <textarea name="comment" rows="2" class="form-control" placeholder="<?php echo !empty($field_comment['placeholder']) ? $field_comment['placeholder'] : ''; ?>"></textarea>
    </div>
<?php } else { ?>
<textarea name="comment" class="hide"></textarea>
<?php } ?>

<?php if ($survey_survey) { ?>
<br /><div class="row reg-fields-survey" id="order-comment">
    <div class="col-sm-5 reg-field">

<div <?php echo $survey_required ? ' class="required"' : ''; ?>>
  <label class="control-label"><strong><?php echo $text_survey; ?></strong></label>
  
    </div>
    </div>
  
  <?php if ($survey_type) { ?>
        
        <div class="col-sm-7" >
        
  <select name="survey" class="form-control">
    <?php foreach ($survey_answers as $survey_answer) { ?>
    <?php if (!empty($survey_answer[$language_id])) { ?>
	  <?php if ($survey == $survey_answer[$language_id]) { ?>
      <option value="<?php echo $survey_answer[$language_id]; ?>" selected="selected"><?php echo $survey_answer[$language_id]; ?></option>
      <?php } else { ?>
	  <option value="<?php echo $survey_answer[$language_id]; ?>"><?php echo $survey_answer[$language_id]; ?></option>
      <?php } ?>
	<?php } ?>
  <?php } ?></select></div>
  <?php } else { ?>
    <div class="col-sm-7" >
  <textarea name="survey" class="form-control" rows="1"><?php echo $survey; ?></textarea>
    </div>
  <?php } ?>
</div><br />
<?php } else { ?>
<textarea name="survey" class="hide"><?php echo $survey; ?></textarea>
<?php } ?>
