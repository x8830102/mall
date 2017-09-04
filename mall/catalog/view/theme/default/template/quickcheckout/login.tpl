<div id="login">
  <div class="col-sm-6 text-left">
	<label class="col-sm-3" for="input-login-email"><?php echo $entry_username; ?></label>
	<div class="col-sm-9">
	  <input style="height: 39px" type="text" name="email" value="" class="form-control" id="input-login-email" />
	</div>
  </div>
  <div class="col-sm-6 text-left">
	<label class="col-sm-3" for="input-login-password"><?php echo $entry_password; ?> <a href="<?php echo $forgotten; ?>" title="<?php echo $text_forgotten; ?>" data-toggle="tooltip"><i class="fa fa-question-circle"></i></a></label>
	<div class="col-sm-9">
	  <div class="input-group">
		<input  style="height: 39px" type="password" name="password" value="" class="form-control" id="input-login-passwd" />
		<span class="input-group-btn">
		  <button type="button" id="button-login" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><?php echo $button_login; ?></button>
		</span>
	  </div>
	</div>
  </div>
</div>

<script type="text/javascript"><!--
$('#login input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#button-login').click();
	}
});
//--></script>   