<div class="vendor-block">
<h3><?php echo $heading_title; ?></h3>
<div class="list-group">
  <button class="btn btn-default dropdown-toggle visible-xs" type="button" data-toggle="dropdown" style="width: 100%">請選擇商店分類
    <span class="caret"></span></button>
<ul class="11" style="top: inherit;left: 5%;background: #000">
  <?php foreach ($categories as $category) { ?>
  <?php if ($category['category_id'] == $category_id) { ?>
  <li><a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a></li>
  <?php if ($category['children']) { ?>
  <?php foreach ($category['children'] as $child) { ?>
  <?php if ($child['category_id'] == $child_id) { ?>
  <li><a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a></li>
  <?php } else { ?>
  <li><a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a></li>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <li><a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $category['name']; ?></a></li>
  <?php } ?>
  <?php } ?>
  </ul>
</div>
</div>
<script>
  $( window ).resize(function() {
  if($(window).width() <=767) $('.11').addClass("dropdown-menu");
  else $('.11').removeClass("dropdown-menu");
});
</script>
<style>
  .dropdown-menu li { list-style: none;background:#000;  }
 .dropdown-menu>li>a { color: rgb(167, 144, 116)!important  }
 .list-group-item.active { color: #fff!important }
 .dropdown-menu { width: 90% }
</style>