<link href="catalog/view/theme/default/stylesheet/mvd_box.css" rel="stylesheet">
<div class="vendor-block">
    <h3><?php echo $heading_title; ?></h3>
    <div class="row product-layout list-unstyled">
	  <article class="vendor-item col-xs-12 col-sm-12 col-md-12" style="padding:5px;text-align:center">
		<?php if ($year) { ?>
		<span style="font-size:120%;color:#666;line-height:0"><?php echo $year; ?></span>
		<?php } 
      $str = explode("/",$_SERVER['REQUEST_URI']);
      $vendor_username = $str[1];
      include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
      $stmt = $pdo_cmg->query("SELECT a_pud FROM memberdata WHERE m_username = '$vendor_username'");
      $check = $stmt->fetch();
      if($check['a_pud'] >= 4 || $check['a_pud'] == 0){
        $vendor_web = 'http://'.$vendor_username.'.lifelink.com.tw';
      }else{
        $vendor_web = 'http://'.$vendor_username.'.lifelink.cc';
      }
    ?>
        <a href="<?php echo $link; ?>" title="<?php echo $title; ?>" class="vendor-thumb">
        <div><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" class="img-responsive -img" style="margin:auto;padding:15px;border-radius:50%" ></div></a>
        <a href="<?php echo $vendor_web; ?>"  style="color: #fff;font-size: 16px;text-decoration:none;background:  #ff8164;padding: 1px 6px;border-radius: 5px;">前往官方網站</a><br>
        <a id="follow" style="color: #fff;font-size: 16px;text-decoration:none;background:  #ff8164;padding: 1px 6px;border-radius: 5px;">追蹤商店</a>
			<div><a href="<?php echo $profile_link; ?>" title="<?php echo $text_findme; ?>"><i class="fa fa-map-marker"></i> 關於本商店</a></div>
			<?php if ($rating) { ?>
                <div class="rating" title="<?php echo $rating . $text_stars; ?>" >
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($rating < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
                  <?php } ?>
                  <?php } ?>
                </div>
            <?php } ?>
        </article>
		<?php if ($vl_installed) { ?>
		<!--<article class="vendor-item col-xs-12 col-sm-12 col-md-12" style="padding:5px">
			<button type="button" onClick="parent.location='<?php echo $link; ?>'" class="btn btn-primary btn-lg btn-block"><i class="fa fa-building-o"></i> <?php echo $text_visit_store; ?></button>
		</article>-->
		<?php } ?>
    </div>
</div>
<style>
  @media (max-width: 767px) {
    .-img {width: 50%}
  }
</style>
<script type="text/javascript">
  $("#follow").on("click", function(){
    var user   = "<?php echo $user;?>";
    var store  = "<?php echo $vendor_username;?>";
    var s_name = "<?php echo $heading_title;?>";
    if(user != ""){
      $.ajax({
            type: "POST",
            dataType: "html",
            data: {
              user: user,
              store: store,
              s_name: s_name
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