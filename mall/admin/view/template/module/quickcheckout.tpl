<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success"><i class="fa fa-save"></i></button>
        <a onclick="$('#form').attr('action', '<?php echo $continue; ?>');$('#form').submit();" data-toggle="tooltip" title="<?php echo $button_continue; ?>" class="btn btn-primary"><i class="fa fa-check"></i></a>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
	<?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>&ensp;
        <i class="fa fa-pencil"></i> <?php echo $entry_store; ?> 
	<select onchange="store();" name="store_id">
            <option value="0"<?php echo $store_id == 0 ? ' selected="selected"' : ''; ?>><?php echo $text_default_store; ?></option>
            <?php foreach ($stores as $store) { ?>
            <option value="<?php echo $store['store_id']; ?>"<?php echo $store_id == $store['store_id'] ? ' selected="selected"' : ''; ?>><?php echo $store['name']; ?></option>
            <?php } ?>
	</select>
      </div>

      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" class="form-horizontal">
		  <ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
			<li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
			<li><a href="#tab-field" data-toggle="tab"><?php echo $tab_field; ?></a></li>
			<li><a href="#tab-payment" data-toggle="tab"><?php echo $tab_payment; ?></a></li>
			<li><a href="#tab-shipping" data-toggle="tab"><?php echo $tab_shipping; ?></a></li>
			<li><a href="#tab-info" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> <?php echo $tab_info; ?></a></li>
                  </ul>
		  <div class="tab-content">
                      
            <div class="tab-pane active" id="tab-general">
                <?php echo $heading_fullversion; ?>
                        <legend>Main</legend>
			  <div class="row">
			    <div class="form-group col-sm-4">
                                <label class="col-sm-7 control-label" for="input-status"><span title="<?php echo $help_status; ?>" data-toggle="tooltip"><?php echo $entry_status; ?></span></label>
				  <div class="col-sm-5">
                                    <div align="center" class="onoffswitch">
                                        <input type="checkbox" name="quickcheckout_status" class="onoffswitch-checkbox" id="quickcheckout_status" value="1" <?php echo ($quickcheckout_status == '1') ? 'checked="checked"' : '' ; ?> >
                                        <label class="onoffswitch-label" for="quickcheckout_status">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-minimum-order"><span title="<?php echo $help_minimum_order; ?>" data-toggle="tooltip"><?php echo $entry_minimum_order; ?></span></label>
				  <div class="col-sm-3">
					<input type="text" name="quickcheckout_minimum_order" value="<?php echo $quickcheckout_minimum_order; ?>" class="form-control" />
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-save-data"><span title="<?php echo $help_save_data; ?>" data-toggle="tooltip"><?php echo $entry_save_data; ?></span></label>
				  <div class="col-sm-5">
                                      
                                    <div align="center" class="onoffswitch">
                                        <input type="checkbox" name="quickcheckout_save_data" class="onoffswitch-checkbox" id="quickcheckout_save_data" value="1" <?php echo ($quickcheckout_save_data == '1') ? 'checked="checked"' : '' ; ?> >
                                        <label class="onoffswitch-label" for="quickcheckout_save_data">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
				  </div>
				</div>
			  </div>
			  <div class="row">
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-edit-cart"><span title="<?php echo $help_edit_cart; ?>" data-toggle="tooltip"><?php echo $entry_edit_cart; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_edit_cart" class="onoffswitch-checkbox" id="quickcheckout_edit_cart" value="1" <?php echo ($quickcheckout_edit_cart == '0') ? '' : '' ; ?> <?php echo $entry_readonly; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_edit_cart">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-highlight-error"><span title="<?php echo $help_highlight_error; ?>" data-toggle="tooltip"><?php echo $entry_highlight_error; ?></span></label>
				  <div class="col-sm-5">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_highlight_error" class="onoffswitch-checkbox" id="quickcheckout_highlight_error" value="1" <?php echo $quickcheckout_highlight_error ? 'checked="checked"' : '' ; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_highlight_error">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-text-error"><span title="<?php echo $help_text_error; ?>" data-toggle="tooltip"><?php echo $entry_text_error; ?></span></label>
				  <div class="col-sm-5">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_text_error" class="onoffswitch-checkbox" id="quickcheckout_text_error" value="1" <?php echo ($quickcheckout_text_error == '1') ? 'checked="checked"' : '' ; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_text_error">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div>
				  </div>
				</div>
			  </div>
			  <div class="row">
			    <div class="form-group col-sm-4">
				  <label class="col-sm-6 control-label" for="input-proceed-button-text"><span title="<?php echo $help_proceed_button_text; ?>" data-toggle="tooltip"><?php echo $entry_proceed_button_text; ?></span></label>
				  <div class="col-sm-6">
					<?php foreach ($languages as $language) { ?>
					  <div class="input-group">
						<span class="input-group-addon"><img src="<?php echo version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png'; ?>" title="<?php echo $language['name']; ?>" /></span>
						<input type="text" name="quickcheckout_proceed_button_text[<?php echo $language['language_id']; ?>]" value="<?php echo !empty($quickcheckout_proceed_button_text[$language['language_id']]) ? $quickcheckout_proceed_button_text[$language['language_id']] : ''; ?>" class="form-control" />
					  </div>
					<?php } ?>
				  </div>
                            </div>
                <!-- dubug -->
                <!--   <div class="form-group col-sm-6" > -->
                       <div class="form-group col-sm-6" hidden>
				  <label class="col-sm-7 control-label" for="input-debug"><span title="<?php echo $help_debug; ?>" data-toggle="tooltip"><?php echo $entry_debug; ?></span></label>
				  <div class="col-sm-5">
					<select name="quickcheckout_debug" id="input-debug" class="form-control">
					  <option value="1"<?php echo $quickcheckout_debug ? ' selected="selected"' : ''; ?>><?php echo $text_enabled; ?></option>
					  <option value="0"<?php echo $quickcheckout_debug ? '' : ' selected="selected"'; ?>><?php echo $text_disabled; ?></option>
					</select>
				  </div>
                            </div>
			  </div>
                
                          <legend>Modules</legend>
                          <div class="row">
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-login-module"><span title="<?php echo $help_login_module; ?>" data-toggle="tooltip"><?php echo $entry_login_module; ?></span></label>
				  <div class="col-sm-5">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_login_module" class="onoffswitch-checkbox" id="quickcheckout_login_module" value="1" <?php echo ($quickcheckout_login_module == '1') ? 'checked="checked"' : '' ; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_login_module">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-cart"><span title="<?php echo $help_cart; ?>" data-toggle="tooltip"><?php echo $entry_cart; ?></span></label>
				  <div class="col-sm-5">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_cart" class="onoffswitch-checkbox" id="quickcheckout_cart" value="1" <?php echo ($quickcheckout_cart == '1') ? 'checked="checked"' : '' ; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_cart">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div>
				  </div>
				</div>
 
                          </div>
			  <div class="row">
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-coupon"><span title="<?php echo $help_coupon; ?>" data-toggle="tooltip"><?php echo $entry_coupon; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_coupon" class="onoffswitch-checkbox" id="quickcheckout_coupon" value="1" <?php echo ($quickcheckout_coupon == '1') ? 'checked="checked"' : 'checked="checked' ; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?>>
                                            <label class="onoffswitch-label" for="quickcheckout_coupon">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-voucher"><span title="<?php echo $help_voucher; ?>" data-toggle="tooltip"><?php echo $entry_voucher; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_voucher" class="onoffswitch-checkbox" id="quickcheckout_voucher" value="1" <?php echo ($quickcheckout_voucher == '1') ? 'checked="checked"' : 'checked="checked"' ; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?>>
                                            <label class="onoffswitch-label" for="quickcheckout_voucher">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-reward"><span title="<?php echo $help_reward; ?>" data-toggle="tooltip"><?php echo $entry_reward; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_reward" class="onoffswitch-checkbox" id="quickcheckout_reward" value="1" <?php echo ($quickcheckout_reward == '1') ? 'checked="checked"' : 'checked="checked"' ; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?>>
                                            <label class="onoffswitch-label" for="quickcheckout_reward">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
			  </div>

                          <legend>Survey</legend>
			  <div class="row">
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-survey"><span title="<?php echo $help_survey; ?>" data-toggle="tooltip"><?php echo $entry_survey; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_survey" class="onoffswitch-checkbox" id="quickcheckout_survey" value="1" <?php echo ($quickcheckout_survey == '1') ? 'checked="checked"' : '' ; ?> <?php echo $entry_readonly; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_survey">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-survey-required"><span title="<?php echo $help_survey_required; ?>" data-toggle="tooltip"><?php echo $entry_survey_required; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_survey_required" class="onoffswitch-checkbox" id="quickcheckout_survey_required" value="1" checked="checked" <?php echo $entry_readonly; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_survey_required">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-4 control-label" for="input-survey-text"><span title="<?php echo $help_survey_text; ?>" data-toggle="tooltip"><?php echo $entry_survey_text; ?></span></label>
				  <div class="col-sm-8">
					<?php foreach ($languages as $language) { ?>
					  <span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><div class="input-group">
						<span class="input-group-addon"><img src="<?php echo version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png'; ?>" title="<?php echo $language['name']; ?>" /></span>
						<input type="text" name="quickcheckout_survey_text[<?php echo $language['language_id']; ?>]" value="Do you like our Quick Checkout module?" class="form-control" readonly />
					  </div></span>
					<?php } ?>
				  </div>
				</div>
                              </div>
                              <div class="row">
				<div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-survey-type"><span title="<?php echo $help_survey_type; ?>" data-toggle="tooltip"><?php echo $entry_survey_type; ?></span></label>
                                  
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
					<select name="quickcheckout_survey_type" id="input-survey-type" class="form-control" readonly>
					  <option value="1" selected="selected"> <?php echo $text_select_type; ?></option>
					  <option value="0"> <?php echo $text_text_type; ?></option>
					</select></span>
				  </div>
                                  
				</div>
			  </div>
			  <div class="col-sm-4">
				<table id="survey-answer" class="table table-hover table-bordered">
				  <thead>
				  <tr>
					<td class="text-left" colspan="2"><?php echo $entry_survey_answer; ?></td>
				  </tr>
				  </thead>
				  <tbody>
				  <?php $survey_answer_row = 0; ?>
				  <?php foreach ($quickcheckout_survey_answers as $survey_answer) { ?>
				  <tr id="survey-answer-<?php echo $survey_answer_row; ?>">
					<td class="text-left"><?php foreach ($languages as $language) { ?>
					  <span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><div class="input-group">
						<span class="input-group-addon"><img src="<?php echo version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png'; ?>" title="<?php echo $language['name']; ?>" /></span>
						<input type="text-text" name="quickcheckout_survey_answers[<?php echo $survey_answer_row; ?>][<?php echo $language['language_id']; ?>]" value="<?php echo !empty($survey_answer[$language['language_id']]) ? $survey_answer[$language['language_id']] : ''; ?>" class="form-control" readonly />
                                              </div></span>
					<?php } ?></td>
                                        <td class="text-right"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><a class="btn btn-danger" ><?php echo $button_remove; ?></a></span></td>
					<?php $survey_answer_row++; ?>
				  </tr>
				  <?php } ?>
				  </tbody>
				  <tfoot>
				  <tr>
                                      <td class="text-right" colspan="2"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><a class="btn btn-success" ><?php echo $button_add; ?></a></span></td>
				  </tr>
				  </tfoot>
				</table>
			  </div>
                        
			</div>
                      
			<div class="tab-pane" id="tab-design">
                            <?php echo $heading_fullversion; ?>
                            <legend>Design</legend>
			  <div class="row">
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-layout"><span title="<?php echo $help_layout; ?>" data-toggle="tooltip"><?php echo $entry_layout; ?></span></label>
				  <div class="col-sm-3"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
					<select name="quickcheckout_layout" id="input-layout" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>>
					  <option value="2"><?php echo $text_one_column; ?></option>
					  <option value="2" selected="selected"><?php echo $text_two_column; ?></option>
					  <option value="2"><?php echo $text_three_column; ?></option>
                                        </select></span>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-responsive"><span title="<?php echo $help_responsive; ?>" data-toggle="tooltip"><?php echo $entry_responsive; ?></span></label>
				  <div class="col-sm-8">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_responsive" class="onoffswitch-checkbox" id="quickcheckout_responsive" value="1" <?php echo ($quickcheckout_responsive == '1') ? 'checked="checked"' : '' ; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_responsive">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div>
				  </div>
				</div>
			  </div>

                          <div class="row">
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-custom-css-heading-background"><?php echo $entry_custom_css_heading_background; ?></label>
				  <div class="col-sm-3">
					<input type="color" name="quickcheckout_custom_css_heading_background" value="<?php echo !empty($quickcheckout_custom_css_heading_background) ? $quickcheckout_custom_css_heading_background : '#EEEEEE'; ?>" placeholder="quickcheckout_custom_css_heading_background" id="input-quickcheckout_custom_css_heading_background" class="form-control" />
				  </div>
				</div>
                              
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-custom-css-heading-font"><?php echo $entry_custom_css_heading_font; ?></label>
				  <div class="col-sm-3">
					<input type="color" name="quickcheckout_custom_css_heading_font" value="<?php echo !empty($quickcheckout_custom_css_heading_font) ? $quickcheckout_custom_css_heading_font : '#000000'; ?>" placeholder="quickcheckout_custom_css_heading_font" id="input-quickcheckout_custom_css_heading_font" class="form-control" />
				  </div>
				</div>
			  </div>
			  <div class="row">

				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-custom-css-border-radius"><?php echo $entry_custom_css_border_radius; ?></label>
				  <div class="col-sm-6">
                                        
                                    <div class="borderswitch">
                                        <input type="checkbox" name="quickcheckout_custom_css_border_radius" class="borderswitch-checkbox" id="myborderswitch" value="sharp" <?php if (isset($quickcheckout_custom_css_border_radius) && ($quickcheckout_custom_css_border_radius == 'sharp'))  echo 'checked="checked"' ; ?> >
                                        <label class="borderswitch-label" for="myborderswitch">
                                            <span class="borderswitch-inner"></span>
                                            <span class="borderswitch-switch"></span>
                                        </label>
                                    </div>

				  </div>
				</div>
                              
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-custom-css-border-color"><?php echo $entry_custom_css_border_color; ?></label>
				  <div class="col-sm-3">
					<input type="color" name="quickcheckout_custom_css_border_color" value="<?php echo !empty($quickcheckout_custom_css_border_color) ? $quickcheckout_custom_css_border_color : '#dddddd'; ?>" placeholder="quickcheckout_custom_css_border-color" id="input-quickcheckout_custom_css_heading_font" class="form-control" />
				  </div>
				</div>
                              
                              </div>

                        <legend>Custom HTML (for advanced users)</legend>
			  <div class="row">
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-html-header"><span title="<?php echo $help_html_header; ?>" data-toggle="tooltip"><?php echo $entry_html_header; ?></span></label>
				  <div class="col-sm-8">
					<?php foreach ($languages as $language) { ?>
					  <div class="input-group">
						<span class="input-group-addon"><img src="<?php echo version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png'; ?>" title="<?php echo $language['name']; ?>" /></span>
						<textarea name="quickcheckout_html_header[<?php echo $language['language_id']; ?>]" rows="4" cols="30" class="form-control"><?php echo !empty($quickcheckout_html_header[$language['language_id']]) ? $quickcheckout_html_header[$language['language_id']] : ''; ?></textarea>
					  </div>
					<?php } ?>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="col-sm-4 control-label" for="input-html-footer"><span title="<?php echo $help_html_footer; ?>" data-toggle="tooltip"><?php echo $entry_html_footer; ?></span></label>
				  <div class="col-sm-8">
					<?php foreach ($languages as $language) { ?>
					  <div class="input-group">
						<span class="input-group-addon"><img src="<?php echo version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png'; ?>" title="<?php echo $language['name']; ?>" /></span>
						<textarea name="quickcheckout_html_footer[<?php echo $language['language_id']; ?>]" rows="4" cols="30" class="form-control"><?php echo !empty($quickcheckout_html_footer[$language['language_id']]) ? $quickcheckout_html_footer[$language['language_id']] : ''; ?></textarea>
					  </div>
					<?php } ?>
				  </div>
				</div>
			  </div>

                            <legend>Custom CSS (for advanced users)</legend>
                              <div class="row">
				<div class="form-group col-sm-12">
				  <label class="col-sm-2 control-label" for="input-custom-css"><?php echo $entry_custom_css; ?></label>
				  <div class="col-sm-10">
				    <textarea name="quickcheckout_custom_css" id="input-custom-css" class="form-control" rows="5"><?php echo $quickcheckout_custom_css; ?></textarea>
				  </div>
				</div>
                              </div>
			</div>
                      
			<div class="tab-pane table-responsive" id="tab-field">
                            <?php echo $heading_fullversion; ?>
                          <legend>Registration Fields</legend>
			  <table class="table table-bordered table-hover table-striped">
				<tr>
				  <td></td>
				  <td class="text-center"><?php echo $text_display; ?></td>
				  <td class="text-center"><?php echo $text_required; ?></td>
				  <td><?php echo $text_presets; ?></td>
				  <td><?php echo $text_sort_order; ?></td>
				</tr>
				<?php foreach ($fields as $field) { ?>
				  <?php if ($field == 'country') { ?>
				  <tr>
					<td><?php echo ${'entry_field_' . $field}; ?></td>
                                        
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[display]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[display]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['display']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[display]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[required]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[required]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['required']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[required]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td>
                                         <div class="row reg-fields">
                                          <div class="col-sm-4 reg-field"><?php echo $text_default; ?></div>
                                          <div class="col-sm-8"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><select name="quickcheckout_field_<?php echo $field; ?>[default]" class="form-control" readonly >
						<option value=""><?php echo $text_select; ?></option>
						<?php foreach ($countries as $country) { ?>
						  <?php if (!empty(${'quickcheckout_field_' . $field}['default']) && ${'quickcheckout_field_' . $field}['default'] == $country['country_id']) { ?>
						  <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
						  <?php } ?>
						<?php } ?>
                                                  </select></span>
                                          </div>
                                         </div>
                                        </td>

                                        <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[sort_order]" value="<?php echo isset(${'quickcheckout_field_' . $field}['sort_order']) ? ${'quickcheckout_field_' . $field}['sort_order'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></td>
				  </tr>
                                  <?php } elseif ($field == 'email') { ?>
				  <tr>
					<td><?php echo ${'entry_field_' . $field}; ?></td>
                                        
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[display]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[display]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['display']) ? ' checked' : ''; ?> onclick="return false" >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[display]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[required]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[required]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['required']) ? ' checked' : ''; ?> onclick="return false" >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[required]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td>
                                         <div class="row reg-fields">
                                          <div class="col-sm-4 reg-field"><?php echo $text_placeholder; ?></div>
                                          <div class="col-sm-8"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[placeholder]" value="<?php echo !empty(${'quickcheckout_field_' . $field}['placeholder']) ? ${'quickcheckout_field_' . $field}['placeholder'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></div>
                                         </div>
                                        </td>

					<?php if ($field == 'comment') { ?>
					<td class="text-center">NA</td>
					<?php } else { ?>
                                        <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[sort_order]" value="<?php echo isset(${'quickcheckout_field_' . $field}['sort_order']) ? ${'quickcheckout_field_' . $field}['sort_order'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></td>
				    <?php } ?>
				  </tr>
				  <?php } elseif ($field == 'zone') { ?>
				  <tr>
					<td><?php echo ${'entry_field_' . $field}; ?></td>
                                        
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[display]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[display]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['display']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[display]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[required]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[required]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['required']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[required]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td>
                                         <div class="row reg-fields">
                                          <div class="col-sm-4 reg-field"><?php echo $text_default; ?></div>
                                          <div class="col-sm-8"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><select name="quickcheckout_field_<?php echo $field; ?>[default]" class="form-control" readonly></select></span></div>
                                         </div>
                                        </td>
                                        <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[sort_order]" value="<?php echo isset(${'quickcheckout_field_' . $field}['sort_order']) ? ${'quickcheckout_field_' . $field}['sort_order'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></td>
				  </tr>
				  <?php } elseif ($field == 'customer_group' || $field == 'address_text') { ?>
				  <tr>
					<td><?php echo ${'entry_field_' . $field}; ?></td>
					                                        
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[display]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[display]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['display']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[display]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
					<td class="text-center"></td>
					<td class="text-center"></td>
                                        <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[sort_order]" value="<?php echo isset(${'quickcheckout_field_' . $field}['sort_order']) ? ${'quickcheckout_field_' . $field}['sort_order'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></td>
				  </tr>
				  <?php } elseif ($field == 'register' || $field == 'newsletter') { ?>
				  <tr>
					<td><?php echo ${'entry_field_' . $field}; ?></td>
                                        
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[display]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[display]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['display']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[display]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                            <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[required]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[required]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['required']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[required]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                            </div></span>
                                        </td>
                                        <td>
                                         <div class="row reg-fields">
                                          <div class="col-sm-4 reg-field"><?php echo $text_default; ?></div>
                                          <div class="col-sm-8 text-center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[default]"<?php echo !empty(${'quickcheckout_field_' . $field}['default']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> /></span></div>
                                         </div>
                                        </td>
                                        <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[sort_order]" value="" style="display:none;" /></span></td>
				  </tr>
				  <?php } else { ?>
				  <tr>
					<td><?php echo ${'entry_field_' . $field}; ?></td>
                                        
                                         <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">                    
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[display]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[display]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['display']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[display]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div></span>
                                    </td>
                                        
					<?php if ($field == 'postcode1') { ?>
					<td class="text-center">NA</td>
					<?php } else { ?>
                                        
                                         <td align="center"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"> 
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_field_<?php echo $field; ?>[required]" class="onoffswitch-checkbox" id="quickcheckout_field_<?php echo $field; ?>[required]" value="1" <?php echo !empty(${'quickcheckout_field_' . $field}['required']) ? ' checked' : ''; ?> <?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_field_<?php echo $field; ?>[required]">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                            </label>
                                        </div></span>
                                    </td>

					<?php } ?>
                                        <td>
                                         <div class="row reg-fields">
                                          <div class="col-sm-4 reg-field"><?php echo $text_placeholder; ?></div>
                                          <div class="col-sm-8"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[placeholder]" value="<?php echo !empty(${'quickcheckout_field_' . $field}['placeholder']) ? ${'quickcheckout_field_' . $field}['placeholder'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></div>
                                         </div>
                                        </td>
					<?php if ($field == 'comment') { ?>
					<td class="text-center"></td>
					<?php } else { ?>
                                        <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_field_<?php echo $field; ?>[sort_order]" value="<?php echo isset(${'quickcheckout_field_' . $field}['sort_order']) ? ${'quickcheckout_field_' . $field}['sort_order'] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?> /></span></td>
				    <?php } ?>
				  </tr>
				  <?php } ?>
				<?php } ?>
			  </table>
			</div>
			<div class="tab-pane" id="tab-payment">
                            <?php echo $heading_fullversion; ?>
                          <legend>Payment Method</legend>
			  <div class="row">
			    <div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-payment-module"><span title="<?php echo $help_payment_module; ?>" data-toggle="tooltip"><?php echo $entry_payment_module; ?></span></label>
				  <div class="col-sm-5">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_payment_module" class="onoffswitch-checkbox" id="quickcheckout_payment_module" value="1" <?php echo ($quickcheckout_payment_module == '1') ? 'checked="checked"' : '' ; ?> >
                                            <label class="onoffswitch-label" for="quickcheckout_payment_module">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-6 control-label" for="input-payment"><span title="<?php echo $help_payment; ?>" data-toggle="tooltip"><?php echo $entry_payment; ?></span></label>
				  <div class="col-sm-6"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
					<select name="quickcheckout_payment" id="input-payment" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>>
					  <option value="1"><?php echo $text_radio_type; ?></option>
					  <option value="0" selected="selected"><?php echo $text_select_type; ?></option>
                                        </select></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-6 control-label" for="input-payment-default"><span title="<?php echo $help_payment_default; ?>" data-toggle="tooltip"><?php echo $entry_payment_default; ?></span></label>
				  <div class="col-sm-6"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
					<select name="quickcheckout_payment_default" id="input-payment-default" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>>
					  <?php foreach ($payment_modules as $payment_module) { ?>
					  <option value="<?php echo $payment_module['code']; ?>"<?php echo $quickcheckout_payment_default == $payment_module['code'] ? ' selected="selected"' : ''; ?>><?php echo $payment_module['name']; ?></option>
					  <?php } ?>
                                        </select></span>
				  </div>
				</div>
			  </div>
			  <table class="table table-bordered table-striped table-hover">
			    <tr>
				  <th></th>
				  <th><span title="<?php echo $help_payment_logo; ?>" data-toggle="tooltip"><?php echo $entry_payment_logo; ?> <i class="fa fa-question-circle"></i></span></th>
				</tr>
				<?php foreach ($payment_modules as $payment_module) { ?>
				<tr>
				  <td><?php echo $payment_module['name']; ?></td>
                                  <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_payment_logo[<?php echo $payment_module['code']; ?>]" value="<?php echo isset($quickcheckout_payment_logo[$payment_module['code']]) ? $quickcheckout_payment_logo[$payment_module['code']] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>/></span></td>
				</tr>
				<?php } ?>
				<tr>
				  <td colspan="2" class="text-center"><?php echo $help_display_more_pay; ?></td>
				</tr>
			  </table>
			</div>
			<div class="tab-pane" id="tab-shipping">
                            <?php echo $heading_fullversion; ?>
                          <legend>Shipping Method</legend>
			  <div class="row">
			    <div class="form-group col-sm-4">
				  <label class="col-sm-7 control-label" for="input-shipping-module"><span title="<?php echo $help_shipping_module; ?>" data-toggle="tooltip"><?php echo $entry_shipping_module; ?></span></label>
				  <div class="col-sm-5"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
                                    <div align="center" class="onoffswitch">
                                            <input type="checkbox" name="quickcheckout_shipping_module" class="onoffswitch-checkbox" id="quickcheckout_shipping_module" value="1" <?php echo ($quickcheckout_shipping_module == '1') ? 'checked="checked"' : '' ; ?><?php echo base64_decode('b25jbGljaz0icmV0dXJuIGZhbHNlIg=='); ?>>
                                            <label class="onoffswitch-label" for="quickcheckout_shipping_module">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                            </label>
                                    </div></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-6 control-label" for="input-shipping"><span title="<?php echo $help_shipping; ?>" data-toggle="tooltip"><?php echo $entry_shipping; ?></span></label>
				  <div class="col-sm-6"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
					<select name="quickcheckout_shipping" id="input-shipping" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>>
					  <option value="1"><?php echo $text_radio_type; ?></option>
					  <option value="0" selected="selected"><?php echo $text_select_type; ?></option>
                                        </select></span>
				  </div>
				</div>
				<div class="form-group col-sm-4">
				  <label class="col-sm-6 control-label" for="input-shipping-default"><span title="<?php echo $help_shipping_default; ?>" data-toggle="tooltip"><?php echo $entry_shipping_default; ?></span></label>
				  <div class="col-sm-6"><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip">
					<select name="quickcheckout_shipping_default" id="input-shipping-default" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>>
					  <?php foreach ($shipping_modules as $shipping_module) { ?>
					  <option value="<?php echo $shipping_module['code']; ?>"<?php echo $quickcheckout_shipping_default == $shipping_module['code'] ? ' selected="selected"' : ''; ?>><?php echo $shipping_module['name']; ?></option>
					  <?php } ?>
                                        </select></span>
				  </div>
				</div>
			  </div>
			  <table class="table table-bordered table-striped table-hover">
			    <tr>
				  <th></th>
				  <th><span title="<?php echo $help_shipping_logo; ?>" data-toggle="tooltip"><?php echo $entry_shipping_logo; ?> <i class="fa fa-question-circle"></i></span></th>
				</tr>
				<?php foreach ($shipping_modules as $shipping_module) { ?>
				<tr>
				  <td><?php echo $shipping_module['name']; ?></td>
                                  <td><span title="<?php echo $help_readonly; ?>" data-toggle="tooltip"><input type="text" name="quickcheckout_shipping_logo[<?php echo $shipping_module['code']; ?>]" value="<?php echo isset($quickcheckout_shipping_logo[$shipping_module['code']]) ? $quickcheckout_shipping_logo[$shipping_module['code']] : ''; ?>" class="form-control" <?php echo base64_decode('cmVhZG9ubHk='); ?>/></span></td>
				</tr>
				<?php } ?>
				<tr>
				  <td colspan="2" class="text-center"><?php echo $help_display_more_ship; ?></td>
				</tr>
			  </table>
			</div>
                      
<div class="tab-pane" id="tab-info">
    <?php echo $heading_fullversion; ?>
    <div class="accordion vertical">
        <ul>
            
            <li>
                <input type="checkbox" id="checkbox-16" name="checkbox-accordion" />
                <label for="checkbox-16" class="manuals">YOU WILL ALSO LIKE THIS</label>
                <div class="content">
                    <p><a href="https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=21609"><img src="https://tobiksoft.com/market/image/ads/ads-quick-ch.jpg" height="250" ></a></p>
                    <p><a href="https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=20225"><img src="https://tobiksoft.com/market/image/ads/ads-quick-reg.jpg" height="250" ></a></p>
                    <p><a href="https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=30272"><img src="https://tobiksoft.com/market/image/ads/ads-quick-bundle.jpg" height="250" ></a></p>
                </div>
            </li>
            
            <li>
                <input type="checkbox" id="checkbox-1" name="checkbox-accordion" />
                <label for="checkbox-1" class="manuals">Install</label>
                <div class="content">
                    <h3>Installation</h3>
                    <p><i class="fa fa-check-square-o"></i>  First You should to backup your Opencart site and database.</p>
                    <p><i class="fa fa-check-square-o"></i>  Unzip the archive.</p>
                    <p><i class="fa fa-check-square-o"></i>  Choose your version of Opencart.</p>
                    <p><i class="fa fa-check-square-o"></i>  Go to: Extensions - Extension installer - Upload your ocmod file (filename.ocmod.zip).</p>
                    <p><i class="fa fa-check-square-o"></i>  Go to: Extensions - Modifications - and click REFRESH button.</p>
                    <p><i class="fa fa-check-square-o"></i>  Goto admin of your shop and navigate to extensions - modules - "{TS} Quick Checkout". And click Install button and then Edit.</p>
                    <p><i class="fa fa-check-square-o"></i>  Then press - Edit.</p>
                    <p><i class="fa fa-check-square-o"></i>  Turn on the {TS} Quick Checkout by click Status ON (General Tab). Set your own settings and press Save button. </p>
                    <p><i class="fa fa-check-square-o"></i>  Done.</p>
                </div>
            </li>
            <li>
                <input type="checkbox" id="checkbox-2" name="checkbox-accordion" />
                <label for="checkbox-2" class="manuals">Update</label>
                <div class="content">
                    <h3>Update</h3>
                    <p><i class="fa fa-check-square-o"></i>  First You should to backup your Opencart site and database.</p>
                    <p><i class="fa fa-check-square-o"></i>  Unzip the archive.</p>
                    <p><i class="fa fa-check-square-o"></i>  Choose your version of Opencart.</p>
                    <p><i class="fa fa-check-square-o"></i>  Unzip ocmod file (filename.ocmod.zip).</p>
                    <p><i class="fa fa-check-square-o"></i>  Copy all from 'upload' folder to your web-root folder.</p>
                    <p><i class="fa fa-check-square-o"></i>  Open and Save again settings of {TS} Quick Checkout module.</p>
                    <p><i class="fa fa-check-square-o"></i>  Done.</p>
                </div>
            </li>
            <li>
                <input type="checkbox" id="checkbox-3" name="checkbox-accordion" />
                <label for="checkbox-3" class="manuals">Usage</label>
                <div class="content">
                    <h3>Usage</h3>
                    <p><i class="fa fa-check-square-o"></i>  Open settings of "{TS} Quick Checkout" module. Setup each tab of settings how you need and press Save button.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-4" name="checkbox-accordion" />
                <label for="checkbox-4" class="manuals">Uninstall</label>
                <div class="content">
                    <h3>Uninstall</h3>
                    <p><i class="fa fa-check-square-o"></i>  Go to: extensions - modules - lacate "{TS} Quick Checkout" module and click Uninstall button.</p>
                    <p><i class="fa fa-check-square-o"></i>  Go to: Extensions - Modifications. Select "{TS} Quick Checkout" - and click DELETE button.</p>
                    <p><i class="fa fa-check-square-o"></i>  Then click REFRESH button on same page.</p>
                </div>
            </li>
            
            <li>
                <input type="checkbox" id="checkbox-15" name="checkbox-accordion" />
                <label for="checkbox-15" class="manuals">UPGRADE to FULL version</label>
                <div class="content">
                    <h3>UPGRADE to FULL version</h3>
                    <p><i class="fa fa-check-square-o"></i>  First You should to backup your Opencart site and database.</p>
                    <p><i class="fa fa-check-square-o"></i>  Uninstall LITE version from 'modules' and delete it from 'modifications'.</p>
                    <p><i class="fa fa-check-square-o"></i>  Make new installation of FULL version.</p>
                </div>
            </li>
            
            <li>
                <input type="checkbox" id="checkbox-6" name="checkbox-accordion" />
                <label for="checkbox-7" class="manuals">How to change language</label>
                <div class="content">
                    <h3>How to change language</h3>
                    <p> By default language files are located: "admin/language/en-gb/module/quickcheckout.php" and "catalog/language/en-gb/quickcheckout/checkout.php". You should modify them yourself. Changes will be shown on your website immediately.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-8" name="checkbox-accordion" />
                <label for="checkbox-8" class="manuals">What versions of OpenCart are supported?</label>
                <div class="content">
                    <h3>What versions of OpenCart are supported?</h3>
                    <p>This extension is compatible with version of Opencart from 2.0.0.0 till latest.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-12" name="checkbox-accordion" />
                <label for="checkbox-12" class="manuals">What isn’t covered by the support?</label>
                <div class="content">
                    <h3>What isn’t covered by the support?</h3>
                    <p>The support is limited to providing bug and issue support. We will not cover custom development and custom design.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-9" name="checkbox-accordion" />
                <label for="checkbox-9" class="manuals">How to open support ticket?</label>
                <div class="content">
                    <h3>How to open support ticket?</h3>
                    <p>Open a SUPPORT TICKET (www.Opencart.com -> page of module -> 'QUICK SUPPORT' button) with us for quick response. </p>
                    <p>Fill in the form and press 'Open a Ticket' button. We would need you to provide as much info as possible about the issue you are having. Right after this a member from our team will get in touch with you with an estimate.</p>    
                    <p>Your issue will be fixed in 48h.</p>
                    <p>Please do not comment in extension page for technical support. We CANNOT assist through the comments section due to the confidential data which you may be sharing with us.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-10" name="checkbox-accordion" />
                <label for="checkbox-10" class="manuals">What exactly do you mean by up to 48 hours?</label>
                <div class="content">
                    <h3>What exactly do you mean by up to 48 hours?</h3>
                    <p>The up to 48 hours guaranteed reply time means that our team will get back to any reported issue in up to 48 hours except (weekends and national holidays). Please mind that debugging an issue might sometimes take more than 48 hours in which case you will be notified.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-6" name="checkbox-accordion" />
                <label for="checkbox-6" class="manuals">How do I provide access to my site?</label>
                <div class="content">
                    <h3>How do I provide access to my site?</h3>
                    <p>In order to fix your issues we will need your web store admin + FTP credentials. Once we finish up the work you can change your credentials.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-7" name="checkbox-accordion" />
                <label for="checkbox-7" class="manuals">How are bugs fixed?</label>
                <div class="content">
                    <h3>How are bugs fixed?</h3>
                    <p>All troubleshooting and issues are fixed using OpenCart’s coding standards, which means that we will not modify your core, thus keeping everything crisp and clean.</p>
                </div>
            </li>

            <li>
                <input type="checkbox" id="checkbox-11" name="checkbox-accordion" />
                <label for="checkbox-11" class="manuals">How do you report finished work?</label>
                <div class="content">
                    <h3>How do you report finished work?</h3>
                    <p>After we finish up the work we will send you a report with the files that we changed.</p>
                </div>
            </li>

        </ul>
    </div>
</div>

                  </div>
		</form>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.form-group + .form-group {
	border: none;
}
</style>

<script type="text/javascript"><!--
function show(element) {
	$(element).tab('show');
	
	$('a[href=\'' + element + '\']').parent('li').siblings().removeClass('active');
	
	$('a[href=\'' + element + '\']').parent('li').addClass('active');
	
	return false;
}

$(document).ready(function() {
	$('.date').datetimepicker();
});

$('select[name=\'quickcheckout_field_country[default]\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=module/quickcheckout/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',		
		success: function(json) {
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo !empty($quickcheckout_field_zone['default']) ? $quickcheckout_field_zone['default'] : ''; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'quickcheckout_field_zone[default]\']').html(html);
		}
	});
});

$('select[name=\'quickcheckout_field_country[default]\']').trigger('change');

$('select[name=\'quickcheckout_survey_type\']').change(function() {
	if ($('select[name=\'quickcheckout_survey_type\']').val() == '1') {
		$('#survey-answer').fadeIn();
	} else {
		$('#survey-answer').fadeOut();
	}
});

$('select[name=\'quickcheckout_survey_type\']').trigger('change');

var survey_answer_row = <?php echo $survey_answer_row; ?>;

function addAnswer() {
	html  = '<tr id="survey-answer-' + survey_answer_row + '">';
	html += '  <td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<div class="input-group"><span class="input-group-addon"><img src="<?php echo version_compare(VERSION, '2.2.0.0', '<') ? 'view/image/flags/' . $language['image'] : 'language/' . $language['code'] . '/' . $language['code'] . '.png'; ?>" title="<?php echo $language['name']; ?>" /></span>';
	html += '<input type="text-text" name="quickcheckout_survey_answers[' + survey_answer_row + '][<?php echo $language['language_id']; ?>]" value="" class="form-control" />';
	html += '</div>';
	<?php } ?>
	html += '  </td>';
	html += '  <td class="text-right"><a class="btn btn-danger" onClick="$(\'#survey-answer-' + survey_answer_row + '\').remove();"><?php echo $button_remove; ?></a></td>';
	html += '</tr>';
	
	$('#survey-answer tbody').append(html);
	
	survey_answer_row++;
}

function store() {
	location = 'index.php?route=module/quickcheckout&token=<?php echo $token; ?>&store_id=' + $('select[name=\'store_id\']').val();
}
//--></script>
<?php echo $footer; ?>