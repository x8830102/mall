<?php include $this->rgen('layout_top'); ?>
<div class="frm-wrp">
	<h2 class="frm-hd"><?php echo $text_my_account; ?></h2>
	<ul class="ul-list-1">
		<li><a href="<?php echo $edit; ?>"><?php echo $text_edit; ?></a></li>
		<li><a href="<?php echo $password; ?>"><?php echo $text_password; ?></a></li>
		<li><a href="<?php echo $address; ?>"><?php echo $text_address; ?></a></li>
		<li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
		<?php 
		$pdo = new PDO("mysql:host=localhost;dbname=lifelink_cc_fans;charset=utf8","lifelinkcc","rgn26842");
		$query = $pdo->query("SELECT domain FROM wp_blogs WHERE domain = '".$data['username'].".lifelink.cc'");
		$check = $query->fetch();
		$pdo = NULL;

		if(empty($check)){ 
		$url = "http://".$data['fname'].".lifelink.cc/Cup-signup.php"; ?>
		<form id="cup-signup" name="cup-signup" method="POST" action="<?php echo $url;?>">
			<input type="hidden" name="fn" id="fn" value="<?php echo $data['fname'];?>">
			<input type="hidden" name="n_name" id="n_name" value="<?php echo $data['username'];?>">
			<input type="hidden" name="n_email" id="n_email" value="<?php echo $data['email'];?>">
			<input type="hidden" name="oc" id="oc" value="1">
		</form>
		<li><a onclick="$('#cup-signup').submit();">創立妮可貓個人網</a></li>
		<?php }else{ ?>
		<li><a href="http://<?php echo $data['username']; ?>.lifelink.cc">我的網站</a></li>
		<?php } ?>
		
	</ul>	
</div>

<div class="frm-wrp">
	<h2 class="frm-hd"><?php echo $text_my_orders; ?></h2>
	<ul class="ul-list-1">
		<li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
		<li><a href="<?php echo $download; ?>"><?php echo $text_download; ?></a></li>
		<?php if ($reward) { ?>
		<li><a href="<?php echo $reward; ?>"><?php echo $text_reward; ?></a></li>
		<?php } ?>
		<li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
		<li><a href="<?php echo $transaction; ?>"><?php echo $text_transaction; ?></a></li>
		<li><a href="<?php echo $recurring; ?>"><?php echo $text_recurring; ?></a></li>
	</ul>
</div>

<div class="frm-wrp">
	<h2 class="frm-hd"><?php echo $text_my_newsletter; ?></h2>
	<ul class="ul-list-1">
		<li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
	</ul>
</div>

<?php 
	include $this->rgen('layout_bottom');
	include $this->rgen('msg_success');
	echo $footer;
?>