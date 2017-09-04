<div id="profile">
  <div><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo $image; ?>" alt="<?php echo $firstname; ?> <?php echo $lastname; ?>" title="<?php echo $username; ?>" class="img-circle" /></a></div>
  <div>
    <h4><?php echo $firstname; ?> <?php echo $lastname; ?></h4>
    <?php if(isset($vendor_id)){ ?>
    	<a href="http://mall.lifelink.com.tw/index.php?route=module/vendorlogo/visitstore&vendor_id=<?php echo $vendor_id; ?>" ><small>進入商城</small></a>
    <?php }else{ ?>
    	<small><?php echo $user_group; ?></small>
    <?php } ?></div>
</div>
