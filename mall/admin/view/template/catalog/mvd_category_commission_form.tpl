<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-commission" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-check-circle"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
	  <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
  <?php } ?>
  <div class="container-fluid">
	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
    <div class="panel-body">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-commission" class="form-horizontal">
		<div class="table-responsive">
			<table id="category-commission" class="table table-striped table-bordered table-hover">
              <thead>
               <tr>
                <td class="text-left"><?php echo $column_category; ?></td>
                <td class="text-left"><?php echo $column_commission; ?></td>
                <td></td>
               </tr>
              </thead>
                <tbody>
                <?php $category_commission_row = 0; ?>
				  <?php if ($commission_categories) { ?>
                  <?php foreach ($commission_categories as $commission_category) { ?>
                    <tr id="category-commission-row<?php echo $category_commission_row; ?>">
                      <td class="text-left"><select name="commission_category[<?php echo $category_commission_row; ?>][category_id]" class="form-control">
                          <?php foreach ($categories as $category) { ?>
                          <?php if ($category['category_id'] == $commission_category['category_id']) { ?>
						  <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
						  <?php } ?>
						  <?php } ?>
                        </select></td>
                      <td class="text-right"><input type="text" name="commission_category[<?php echo $category_commission_row; ?>][commission_rate]" value="<?php echo $commission_category['commission_rate']; ?>" placeholder="<?php echo $entry_commission; ?>" class="form-control" /></td>
                      <td class="text-left"><button type="button" onclick="$('#category-commission-row<?php echo $category_commission_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                    </tr>
                    <?php $category_commission_row++; ?>
                  <?php } ?>
				  <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td class="text-left"><button type="button" onclick="add_commission_category();" data-toggle="tooltip" title="<?php echo $button_add_category; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
                    </tr>
                </tfoot>
            </table>
		</div>
    </form>
	</div>
	</div>
  </div>
</div>
<script type="text/javascript"><!--
	var category_commission_row = <?php echo $category_commission_row; ?>;
	function add_commission_category() {
		html  = '<tr id="category-commission-row' + category_commission_row + '">'; 
		html += '  <td class="text-left"><select name="commission_category[' + category_commission_row + '][category_id]" class="form-control">';
		<?php foreach ($categories as $category) { ?>
		html += '      <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>';
		<?php } ?>
		html += '  </select></td>';
		html += '  <td class="text-right"><input type="text" name="commission_category[' + category_commission_row + '][commission_rate]" value="" placeholder="<?php echo $entry_commission; ?>" class="form-control" /></td>';
		html += '  <td class="text-left"><button type="button" onclick="$(\'#category-commission-row' + category_commission_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
		html += '</tr>';
		$('#category-commission tbody').append(html);
		category_commission_row++;
	}
//--></script>
<?php echo $footer; ?>