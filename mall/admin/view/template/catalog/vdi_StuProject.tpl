<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
	  <div class="pull-right">
		<?php if(!isset($button_cancel)){ ?>
	    <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
		<?php }else{?>
		<button type="button" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-product').submit() : false;"><i class="fa fa-save"></i></button>
		<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
		<?php }?>
	  </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>

  <div class="container-fluid">
    <div class="panel panel-default">
	  <div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-list"></i> <?php if(!empty($text_list)){echo $text_list;}else{ echo $text_add; }?></h3>
	  </div>
	  <div class="panel-body">
		<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-product">
		  <div class="table-responsive">
			<table class="table table-bordered table-hover">
			  <thead>
				<tr>
				  <td>
				  </td>
				  <td class="text-center"><?php echo $column_image; ?></td>
				  <td class="text-center"><?php echo $column_name; ?></td>
				  <td class="text-center"><?php echo $column_price; ?></td>
				  <td class="text-center"><?php echo $column_quantity; ?></td>
				</tr>
			  </thead>
			  <tbody>
			  <?php if(isset($products)){ ?>
			  <?php   foreach($products as $product){ ?>
						<tr>
						  <td class="text-center">
							<input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>"  />
						  </td>
						  <td class="text-center"><?php if(!empty($product['image'])){ ?> 
							<img src="<?php echo $product['image']; ?>"  class="img-thumbnail">
							<?php }else{ ?>
							<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
							<?php }?>
						  </td>
						  <td class="text-center"><?php echo $product['name']; ?></td>
						  <td class="text-center"><?php echo $product['price']; ?></td>
						  <td class="text-center"><?php echo $product['quantity']; ?></td>
						  
						</tr>
			  <?php   }?>
			  <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?> 
			  </tbody>
			</table>
		  </div>
		</form>
	  </div>
	</div>
  </div>
</div>

<?php echo $footer; ?>