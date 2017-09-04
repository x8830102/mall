<?php
class ControllerModuleQuickCheckout extends Controller {
	protected $extension = 'checkout';
	protected $error = array();

	public function index() {
		$this->load->language('module/quickcheckout');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));
		
		if (isset($this->request->get['store_id'])) {
			$store_id = $this->request->get['store_id'];
		} else {
			$store_id = 0;
		}
		
		$this->load->model('setting/setting');
                
                $extension = $this->extension;                
                
		if (file_exists('view/stylesheet/onepagecheckout.css')) {
                        $this->document->addStyle('view/stylesheet/onepagecheckout.css');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('quickcheckout', $this->request->post, $store_id);		
			
			$this->session->data['success'] = $this->language->get('text_success');
		
			if (!isset($this->request->get['continue'])) {
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true));
			} else {
				$this->response->redirect($this->url->link('module/quickcheckout', 'token=' . $this->session->data['token'] . '&store_id=' . $store_id, true));
			}
		}
	
		// All fields
		$fields = array(
			'firstname',
			'lastname',
			'email',
			'telephone',
			'fax',
                        'address_text',
			'company',
			'customer_group',
			'address_1',
			'address_2',
			'city',
			'postcode',
			'country',
			'zone',
			'newsletter',
			'register',
			'comment'
		);
                
		$fields2 = array(
			'firstname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'First Name',
					'sort_order'	=> '1'
				),
			'lastname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'Last Name',
					'sort_order'	=> '2'
				),
			'email'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'E-Mail',
					'sort_order'	=> '3'
				),
			'telephone'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'		=> 'Telephone',
					'sort_order'	=> '4'
				),
			'fax'			=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Fax',
					'sort_order'	=> '5'
				),
			'address_text'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'		=> '',
					'sort_order'	=> '6'
				),
			'company'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Company',
					'sort_order'	=> '7'
				),
			'customer_group' => array(
					'display'		=> '1',
					'required'		=> '',
					'default'		=> '',
					'sort_order'	=> '8'
				),
			'address_1'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'Address',
					'sort_order'	=> '9'
				),
			'address_2'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Additional Address',
					'sort_order'	=> '10'
				),
			'city'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'City',
					'sort_order'	=> '11'
				),
			'postcode'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Post Code',
					'sort_order'	=> '12'
				),
			'country'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'default'		=> $this->config->get('config_country_id'),
					'sort_order'	=> '13'
				),
			'zone'			=> array(
					'display'		=> '0',
					'required'		=> '0',
					'default'		=> $this->config->get('config_zone_id'),
					'sort_order'	=> '14'
				),
			'newsletter'	=> array(
					'display'		=> '1',
					'required'		=> '0',
					'default'		=> '0',
					'sort_order'	=> ''
				),
			'register'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'default'		=> '',
					'sort_order'	=> ''
				),
			'comment'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'		=> 'Add Comments About Your Order',
					'sort_order'	=> ''
				)
		);
		
		$data['fields'] = $fields;


		$this->load->model('localisation/country');
                
                $country_info = $this->model_localisation_country->getCountry('222');
                
                $this->load->model('localisation/zone');
                $data['testzone'] = $this->model_localisation_zone->getZonesByCountryId('222');
                                
		$data['heading_title'] = $this->language->get('heading_title');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_field'] = $this->language->get('tab_field');
		$data['tab_payment'] = $this->language->get('tab_payment');
		$data['tab_shipping'] = $this->language->get('tab_shipping');
                $data['tab_info'] = $this->language->get('tab_info');
		$data['help_status'] = $this->language->get('help_status');
		$data['help_confirmation_page'] = $this->language->get('help_confirmation_page');
		$data['help_load_screen'] = $this->language->get('help_load_screen');
		$data['help_loading_display'] = $this->language->get('help_loading_display');
		$data['help_payment_logo'] = $this->language->get('help_payment_logo');
		$data['help_shipping_logo'] = $this->language->get('help_shipping_logo');
		$data['help_payment'] = $this->language->get('help_payment');
		$data['help_shipping'] = $this->language->get('help_shipping');
		$data['help_payment_default'] = $this->language->get('help_payment_default');
		$data['help_shipping_default'] = $this->language->get('help_shipping_default');
		$data['help_edit_cart'] = $this->language->get('help_edit_cart');
		$data['help_highlight_error'] = $this->language->get('help_highlight_error');
		$data['help_text_error'] = $this->language->get('help_text_error');
		$data['help_layout'] = $this->language->get('help_layout');
		$data['help_slide_effect'] = $this->language->get('help_slide_effect');
		$data['help_minimum_order'] = $this->language->get('help_minimum_order');
		$data['help_save_data'] = $this->language->get('help_save_data');
		$data['help_debug'] = $this->language->get('help_debug');
		$data['help_auto_submit'] = $this->language->get('help_auto_submit');
		$data['help_payment_target'] = $this->language->get('help_payment_target');
		$data['help_proceed_button_text'] = $this->language->get('help_proceed_button_text');
                $data['help_readonly'] = $this->language->get('help_readonly');
		$data['help_responsive'] = $this->language->get('help_responsive');
		$data['help_payment_reload'] = $this->language->get('help_payment_reload');
		$data['help_shipping_reload'] = $this->language->get('help_shipping_reload');
		$data['help_voucher'] = $this->language->get('help_voucher');
		$data['help_coupon'] = $this->language->get('help_coupon');
		$data['help_reward'] = $this->language->get('help_reward');
		$data['help_cart'] = $this->language->get('help_cart');
		$data['help_shipping_module'] = $this->language->get('help_shipping_module');
		$data['help_payment_module'] = $this->language->get('help_payment_module');
		$data['help_login_module'] = $this->language->get('help_login_module');
		$data['help_html_header'] = $this->language->get('help_html_header');
		$data['help_html_footer'] = $this->language->get('help_html_footer');
                $data['help_survey'] = $this->language->get('help_survey');
		$data['help_survey_required'] = $this->language->get('help_survey_required');
		$data['help_survey_text'] = $this->language->get('help_survey_text');
		$data['help_survey_type'] = $this->language->get('help_survey_type');
		$data['help_survey_answer'] = $this->language->get('help_survey_answer');
		$data['help_display_more'] = $this->language->get('help_display_more');
		$data['help_display_more_pay'] = $this->language->get('help_display_more_pay');
		$data['help_display_more_ship'] = $this->language->get('help_display_more_ship');
                $data['help_ts_order_id'] = $this->language->get('help_ts_order_id');
                $data['help_ts_order_email'] = $this->language->get('help_ts_order_email');
                $data['help_ts_order_web'] = $this->language->get('help_ts_order_web');
                $data['help_ts_order_st'] = $this->language->get('help_ts_order_st');
		$data['text_default_store'] = $this->language->get('text_default_store');
                $data['heading_fullversion'] = $this->language->get('heading_fullversion');
		$data['text_general'] = $this->language->get('text_general');
		$data['text_design'] = $this->language->get('text_design');
		$data['text_field'] = $this->language->get('text_field');
		$data['text_module_home'] = $this->language->get('text_module_home');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_survey'] = $this->language->get('text_survey');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_radio_type'] = $this->language->get('text_radio_type');
		$data['text_select_type'] = $this->language->get('text_select_type');
		$data['text_text_type'] = $this->language->get('text_text_type');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_one_column'] = $this->language->get('text_one_column');
		$data['text_two_column'] = $this->language->get('text_two_column');
		$data['text_three_column'] = $this->language->get('text_three_column');
		$data['text_estimate'] = $this->language->get('text_estimate');
		$data['text_choose'] = $this->language->get('text_choose');
		$data['text_day'] = $this->language->get('text_day');
		$data['text_specific'] = $this->language->get('text_specific');
		$data['text_display'] = $this->language->get('text_display');
		$data['text_required'] = $this->language->get('text_required');
                $data['text_presets'] = $this->language->get('text_presets');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_placeholder'] = $this->language->get('text_placeholder');
		$data['text_sort_order'] = $this->language->get('text_sort_order');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_overlay'] = $this->language->get('text_overlay');
		$data['text_spinner'] = $this->language->get('text_spinner');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_minimum_order'] = $this->language->get('entry_minimum_order');
		$data['entry_debug'] = $this->language->get('entry_debug');
		$data['entry_confirmation_page'] = $this->language->get('entry_confirmation_page');
		$data['entry_save_data'] = $this->language->get('entry_save_data');
		$data['entry_edit_cart'] = $this->language->get('entry_edit_cart');
		$data['entry_highlight_error'] = $this->language->get('entry_highlight_error');
		$data['entry_text_error'] = $this->language->get('entry_text_error');
		$data['entry_auto_submit'] = $this->language->get('entry_auto_submit');
                $data['entry_ts_order_id'] = $this->language->get('entry_ts_order_id');
                $data['entry_ts_order_email'] = $this->language->get('entry_ts_order_email');
                $data['entry_ts_order_web'] = $this->language->get('entry_ts_order_web');                
		$data['entry_payment_target'] = $this->language->get('entry_payment_target');
		$data['entry_proceed_button_text'] = $this->language->get('entry_proceed_button_text');
                $data['entry_readonly'] = $this->language->get('entry_readonly');
		$data['entry_load_screen'] = $this->language->get('entry_load_screen');
		$data['entry_loading_display'] = $this->language->get('entry_loading_display');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_responsive'] = $this->language->get('entry_responsive');
		$data['entry_slide_effect'] = $this->language->get('entry_slide_effect');
		$data['entry_custom_css_heading_background'] = $this->language->get('entry_custom_css_heading_background');
                $data['entry_custom_css_heading_font'] = $this->language->get('entry_custom_css_heading_font');
                $data['entry_custom_css_border_radius'] = $this->language->get('entry_custom_css_border_radius');
                $data['entry_custom_css_border_color'] = $this->language->get('entry_custom_css_border_color');
                $data['entry_custom_css'] = $this->language->get('entry_custom_css');
		foreach ($fields as $field) {
			$data['entry_field_' . $field] = $this->language->get('entry_field_' . $field);
		}
		$data['entry_voucher'] = $this->language->get('entry_voucher');
		$data['entry_coupon'] = $this->language->get('entry_coupon');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_cart'] = $this->language->get('entry_cart');
		$data['entry_login_module'] = $this->language->get('entry_login_module');
		$data['entry_html_header'] = $this->language->get('entry_html_header');
		$data['entry_html_footer'] = $this->language->get('entry_html_footer');
		$data['entry_payment_module'] = $this->language->get('entry_payment_module');
		$data['entry_payment_reload'] = $this->language->get('entry_payment_reload');
		$data['entry_payment'] = $this->language->get('entry_payment');
		$data['entry_payment_default'] = $this->language->get('entry_payment_default');
		$data['entry_payment_logo'] = $this->language->get('entry_payment_logo');
		$data['entry_shipping_module'] = $this->language->get('entry_shipping_module');
		$data['entry_shipping_reload'] = $this->language->get('entry_shipping_reload');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_shipping_default'] = $this->language->get('entry_shipping_default');
		$data['entry_shipping_logo'] = $this->language->get('entry_shipping_logo');
		$data['entry_survey'] = $this->language->get('entry_survey');
		$data['entry_survey_required'] = $this->language->get('entry_survey_required');
		$data['entry_survey_text'] = $this->language->get('entry_survey_text');
		$data['entry_survey_type'] = $this->language->get('entry_survey_type');
		$data['entry_survey_answer'] = $this->language->get('entry_survey_answer');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_remove'] = $this->language->get('button_remove');
		
		$data['token'] = $this->session->data['token'];
		
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
                
		$setting = $this->model_setting_setting->getSetting('quickcheckout', $store_id);

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true)
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/quickcheckout', 'token=' . $this->session->data['token'], true)
   		);

                $data['action'] = $this->url->link('module/quickcheckout', 'token=' . $this->session->data['token'] . '&store_id=' . $store_id, true);
                $data['continue'] = $this->url->link('module/quickcheckout', 'token=' . $this->session->data['token'] . '&continue=1&store_id=' . $store_id, true);
                $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true);

		if (isset($this->request->post['quickcheckout_status'])) {
			$data['quickcheckout_status'] = $this->request->post['quickcheckout_status'];
		} elseif (isset($setting['quickcheckout_status'])) {
			$data['quickcheckout_status'] = $setting['quickcheckout_status'];
		} else {
			$data['quickcheckout_status'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_minimum_order'])) {
			$data['quickcheckout_minimum_order'] = $this->request->post['quickcheckout_minimum_order'];
		} elseif (isset($setting['quickcheckout_minimum_order'])) {
			$data['quickcheckout_minimum_order'] = $setting['quickcheckout_minimum_order'];
		} else {
			$data['quickcheckout_minimum_order'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_debug'])) {
			$data['quickcheckout_debug'] = $this->request->post['quickcheckout_debug'];
		} elseif (isset($setting['quickcheckout_debug'])) {
			$data['quickcheckout_debug'] = $setting['quickcheckout_debug'];
		} else {
			$data['quickcheckout_debug'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_confirmation_page'])) {
			$data['quickcheckout_confirmation_page'] = $this->request->post['quickcheckout_confirmation_page'];
		} elseif (isset($setting['quickcheckout_confirmation_page'])) {
			$data['quickcheckout_confirmation_page'] = $setting['quickcheckout_confirmation_page'];
		} else {
			$data['quickcheckout_confirmation_page'] = 1;
		}
		
		if (isset($this->request->post['quickcheckout_save_data'])) {
			$data['quickcheckout_save_data'] = $this->request->post['quickcheckout_save_data'];
		} elseif (isset($setting['quickcheckout_save_data'])) {
			$data['quickcheckout_save_data'] = $setting['quickcheckout_save_data'];
		} else {
			$data['quickcheckout_save_data'] = 0;
		}

		$data['quickcheckout_edit_cart'] = 0;

		if (isset($this->request->post['quickcheckout_highlight_error'])) {
			$data['quickcheckout_highlight_error'] = $this->request->post['quickcheckout_highlight_error'];
		} elseif (isset($setting['quickcheckout_highlight_error'])) {
			$data['quickcheckout_highlight_error'] = $setting['quickcheckout_highlight_error'];
		} else {
			$data['quickcheckout_highlight_error'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_text_error'])) {
			$data['quickcheckout_text_error'] = $this->request->post['quickcheckout_text_error'];
		} elseif (isset($setting['quickcheckout_text_error'])) {
			$data['quickcheckout_text_error'] = $setting['quickcheckout_text_error'];
		} else {
			$data['quickcheckout_text_error'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_auto_submit'])) {
			$data['quickcheckout_auto_submit'] = $this->request->post['quickcheckout_auto_submit'];
		} elseif (isset($setting['quickcheckout_auto_submit'])) {
			$data['quickcheckout_auto_submit'] = $setting['quickcheckout_auto_submit'];
		} else {
			$data['quickcheckout_auto_submit'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_payment_target'])) {
			$data['quickcheckout_payment_target'] = $this->request->post['quickcheckout_payment_target'];
		} elseif (isset($setting['quickcheckout_payment_target'])) {
			$data['quickcheckout_payment_target'] = $setting['quickcheckout_payment_target'];
		} else {
			$data['quickcheckout_payment_target'] = '#button-confirm, .button, .btn';
		}
		
		if (isset($this->request->post['quickcheckout_proceed_button_text'])) {
			$data['quickcheckout_proceed_button_text'] = $this->request->post['quickcheckout_proceed_button_text'];
		} elseif (isset($setting['quickcheckout_proceed_button_text']) && is_array($setting['quickcheckout_proceed_button_text'])) {
			$data['quickcheckout_proceed_button_text'] = $setting['quickcheckout_proceed_button_text'];
		} else {
			$data['quickcheckout_proceed_button_text'] = array();
		}

		$data['quickcheckout_load_screen'] = 0;
                
		$data['quickcheckout_loading_display'] = 0;
                
		$data['quickcheckout_layout'] = 2;

		if (isset($this->request->post['quickcheckout_responsive'])) {
			$data['quickcheckout_responsive'] = $this->request->post['quickcheckout_responsive'];
		} elseif (isset($setting['quickcheckout_responsive'])) {
			$data['quickcheckout_responsive'] = $setting['quickcheckout_responsive'];
		} else {
			$data['quickcheckout_responsive'] = 0;
		}

		$data['quickcheckout_slide_effect'] = 0;

                if (isset($this->request->post['quickcheckout_custom_css_heading_background'])) {
			$data['quickcheckout_custom_css_heading_background'] = $this->request->post['quickcheckout_custom_css_heading_background'];
		} elseif (isset($setting['quickcheckout_custom_css_heading_background'])) {
			$data['quickcheckout_custom_css_heading_background'] = $setting['quickcheckout_custom_css_heading_background'];
		} else {
			$data['quickcheckout_custom_css_heading_background'] = '';
		}

                if (isset($this->request->post['quickcheckout_custom_css_heading_font'])) {
			$data['quickcheckout_custom_css_heading_font'] = $this->request->post['quickcheckout_custom_css_heading_font'];
		} elseif (isset($setting['quickcheckout_custom_css_heading_font'])) {
			$data['quickcheckout_custom_css_heading_font'] = $setting['quickcheckout_custom_css_heading_font'];
		} else {
			$data['quickcheckout_custom_css_heading_font'] = '';
		}

                if (isset($this->request->post['quickcheckout_custom_css_border_radius'])) {
			$data['quickcheckout_custom_css_border_radius'] = $this->request->post['quickcheckout_custom_css_border_radius'];
		} elseif (isset($setting['quickcheckout_custom_css_border_radius'])) {
			$data['quickcheckout_custom_css_border_radius'] = $setting['quickcheckout_custom_css_border_radius'];
		} else {
			$data['quickcheckout_custom_css_border_radius'] = '';
		}

                if (isset($this->request->post['quickcheckout_custom_css_border_color'])) {
			$data['quickcheckout_custom_css_border_color'] = $this->request->post['quickcheckout_custom_css_border_color'];
		} elseif (isset($setting['quickcheckout_custom_css_border_color'])) {
			$data['quickcheckout_custom_css_border_color'] = $setting['quickcheckout_custom_css_border_color'];
		} else {
			$data['quickcheckout_custom_css_border_color'] = '';
		}

                
		if (isset($this->request->post['quickcheckout_custom_css'])) {
			$data['quickcheckout_custom_css'] = $this->request->post['quickcheckout_custom_css'];
		} elseif (isset($setting['quickcheckout_custom_css'])) {
			$data['quickcheckout_custom_css'] = $setting['quickcheckout_custom_css'];
		} else {
			$data['quickcheckout_custom_css'] = '';
		}
		
		
		foreach ($fields as $field) {
			if (isset($this->request->post['quickcheckout_field_' . $field])) {
				$data['quickcheckout_field_' . $field] = $this->request->post['quickcheckout_field_' . $field];
			} elseif (isset($fields2[$field]) && is_array($fields2[$field])) {
				$data['quickcheckout_field_' . $field] = $fields2[$field];
			} else {
				$data['quickcheckout_field_' . $field] = array();
			}
		}
		
		$data['quickcheckout_coupon'] = 1;
                
		$data['quickcheckout_voucher'] = 1;
                
		$data['quickcheckout_reward'] = 1;
		
		if (isset($this->request->post['quickcheckout_cart'])) {
			$data['quickcheckout_cart'] = $this->request->post['quickcheckout_cart'];
		} elseif (isset($setting['quickcheckout_cart'])) {
			$data['quickcheckout_cart'] = $setting['quickcheckout_cart'];
		} else {
			$data['quickcheckout_cart'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_login_module'])) {
			$data['quickcheckout_login_module'] = $this->request->post['quickcheckout_login_module'];
		} elseif (isset($setting['quickcheckout_login_module'])) {
			$data['quickcheckout_login_module'] = $setting['quickcheckout_login_module'];
		} else {
			$data['quickcheckout_login_module'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_html_header'])) {
			$data['quickcheckout_html_header'] = $this->request->post['quickcheckout_html_header'];
		} elseif (isset($setting['quickcheckout_html_header']) && is_array($setting['quickcheckout_html_header'])) {
			$data['quickcheckout_html_header'] = $setting['quickcheckout_html_header'];
		} else {
			$data['quickcheckout_html_header'] = array();
		}
		
		if (isset($this->request->post['quickcheckout_html_footer'])) {
			$data['quickcheckout_html_footer'] = $this->request->post['quickcheckout_html_footer'];
		} elseif (isset($setting['quickcheckout_html_footer']) && is_array($setting['quickcheckout_html_footer'])) {
			$data['quickcheckout_html_footer'] = $setting['quickcheckout_html_footer'];
		} else {
			$data['quickcheckout_html_footer'] = array();
		}
		
		if (isset($this->request->post['quickcheckout_payment_module'])) {
			$data['quickcheckout_payment_module'] = $this->request->post['quickcheckout_payment_module'];
		} elseif (isset($setting['quickcheckout_payment_module'])) {
			$data['quickcheckout_payment_module'] = $setting['quickcheckout_payment_module'];
		} else {
			$data['quickcheckout_payment_module'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_payment_reload'])) {
			$data['quickcheckout_payment_reload'] = $this->request->post['quickcheckout_payment_reload'];
		} elseif (isset($setting['quickcheckout_payment_reload'])) {
			$data['quickcheckout_payment_reload'] = $setting['quickcheckout_payment_reload'];
		} else {
			$data['quickcheckout_payment_reload'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_payment'])) {
			$data['quickcheckout_payment'] = $this->request->post['quickcheckout_payment'];
		} elseif (isset($setting['quickcheckout_payment'])) {
			$data['quickcheckout_payment'] = $setting['quickcheckout_payment'];
		} else {
			$data['quickcheckout_payment'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_payment_default'])) {
			$data['quickcheckout_payment_default'] = $this->request->post['quickcheckout_payment_default'];
		} elseif (isset($setting['quickcheckout_payment_default'])) {
			$data['quickcheckout_payment_default'] = $setting['quickcheckout_payment_default'];
		} else {
			$data['quickcheckout_payment_default'] = '';
		}
		
		$data['quickcheckout_payment_logo'] = array();
		
		$data['quickcheckout_shipping_module'] = 1;
		
		if (isset($this->request->post['quickcheckout_shipping'])) {
			$data['quickcheckout_shipping'] = $this->request->post['quickcheckout_shipping'];
		} elseif (isset($setting['quickcheckout_shipping'])) {
			$data['quickcheckout_shipping'] = $setting['quickcheckout_shipping'];
		} else {
			$data['quickcheckout_shipping'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_shipping_default'])) {
			$data['quickcheckout_shipping_default'] = $this->request->post['quickcheckout_shipping_default'];
		} elseif (isset($setting['quickcheckout_shipping_default'])) {
			$data['quickcheckout_shipping_default'] = $setting['quickcheckout_shipping_default'];
		} else {
			$data['quickcheckout_shipping_default'] = 0;
		}
		
		if (isset($this->request->post['quickcheckout_shipping_reload'])) {
			$data['quickcheckout_shipping_reload'] = $this->request->post['quickcheckout_shipping_reload'];
		} elseif (isset($setting['quickcheckout_shipping_reload'])) {
			$data['quickcheckout_shipping_reload'] = $setting['quickcheckout_shipping_reload'];
		} else {
			$data['quickcheckout_shipping_reload'] = 0;
		}

		$data['quickcheckout_shipping_logo'] = array();

		$data['quickcheckout_survey'] = 1;
		
		$data['quickcheckout_survey_required'] = 1;
		
		$data['quickcheckout_survey_text'] = array();
		
		$data['quickcheckout_survey_type'] = 1;
		
		if (isset($this->request->post['quickcheckout_survey_answers'])) {
			$data['quickcheckout_survey_answers'] = $this->request->post['quickcheckout_survey_answers'];
		} elseif (isset($setting['quickcheckout_survey_answers']) && is_array($setting['quickcheckout_survey_answers'])) {
			$data['quickcheckout_survey_answers'] = $setting['quickcheckout_survey_answers'];
		} else {
			$data['quickcheckout_survey_answers'] = array();
		}
		
		$data['store_id'] = $store_id;
		
		$this->load->model('setting/store');
		
		$data['stores'] = $this->model_setting_store->getStores();
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/country');
		
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		// Payment
		$files = glob(DIR_APPLICATION . 'controller/payment/*.php');
		
		$data['payment_modules'] = array();
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');

				if ($this->config->get($extension . '_status')) {
					$this->load->language('payment/' . $extension);

					$data['payment_modules'][] = array(
						'name'		=> $this->language->get('heading_title'),
						'code'		=> $extension
					);
				}
			}
		}
		
		$files = glob(DIR_APPLICATION . 'controller/shipping/*.php');
		
		$data['shipping_modules'] = array();
		
		if ($files) {
			foreach ($files as $file) {
				$extension = basename($file, '.php');

				if ($this->config->get($extension . '_status')) {
					$this->load->language('shipping/' . $extension);

					$data['shipping_modules'][] = array(
						'name'		=> $this->language->get('heading_title'),
						'code'		=> $extension
					);
				}
			}
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/quickcheckout.tpl', $data));
	}
	
	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']		
			);
		}

		$this->response->setOutput(json_encode($json));
	}
	
	public function install(){
		if (!$this->user->hasPermission('modify', 'extension/module')) {
			return;
		}
		
		$this->load->language('module/quickcheckout');
		
		$this->load->model('setting/setting');
		
		$data = array(
			'quickcheckout_status'				=> '1',
			'quickcheckout_minimum_order'		=> '0',
			'quickcheckout_debug'				=> '0',
			'quickcheckout_confirmation_page'	=> '0',
			'quickcheckout_save_data'			=> '1',
			'quickcheckout_edit_cart'			=> '0',
			'quickcheckout_highlight_error'		=> '1',
			'quickcheckout_text_error'			=> '1',
			'quickcheckout_auto_submit'			=> '0',
			'quickcheckout_payment_target'		=> '0',
			'quickcheckout_load_screen'			=> '0',
			'quickcheckout_loading_display'		=> '0',
			'quickcheckout_layout'				=> '2',
			'quickcheckout_responsive'			=> '1',
			'quickcheckout_slide_effect'		=> '0',
			'quickcheckout_field_firstname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'First Name',
					'sort_order'	=> '1'
				),
			'quickcheckout_field_lastname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'Last Name',
					'sort_order'	=> '2'
				),
			'quickcheckout_field_email'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'E-Mail',
					'sort_order'	=> '3'
				),
			'quickcheckout_field_telephone'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'		=> 'Telephone',
					'sort_order'	=> '4'
				),
			'quickcheckout_field_fax'			=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Fax',
					'sort_order'	=> '5'
				),
			'quickcheckout_field_address_text'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'		=> '',
					'sort_order'	=> '6'
				),
			'quickcheckout_field_company'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Company',
					'sort_order'	=> '7'
				),
			'quickcheckout_field_customer_group' => array(
					'display'		=> '1',
					'required'		=> '',
					'default'		=> '',
					'sort_order'	=> '8'
				),
			'quickcheckout_field_address_1'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'Address',
					'sort_order'	=> '9'
				),
			'quickcheckout_field_address_2'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Additional Address',
					'sort_order'	=> '10'
				),
			'quickcheckout_field_city'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> 'City',
					'sort_order'	=> '11'
				),
			'quickcheckout_field_postcode'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'		=> 'Post Code',
					'sort_order'	=> '12'
				),
			'quickcheckout_field_country'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'default'		=> $this->config->get('config_country_id'),
					'sort_order'	=> '13'
				),
			'quickcheckout_field_zone'			=> array(
					'display'		=> '0',
					'required'		=> '0',
					'default'		=> $this->config->get('config_zone_id'),
					'sort_order'	=> '14'
				),
			'quickcheckout_field_newsletter'	=> array(
					'display'		=> '0',
					'required'		=> '0',
					'default'		=> '1',
					'sort_order'	=> ''
				),
			'quickcheckout_field_register'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'default'		=> '',
					'sort_order'	=> ''
				),
			'quickcheckout_field_comment'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'		=> 'Add Comments About Your Order',
					'sort_order'	=> ''
				),
			'quickcheckout_coupon'				=> '1',
			'quickcheckout_voucher'				=> '1',
			'quickcheckout_reward'				=> '1',
			'quickcheckout_cart'				=> '1',
			'quickcheckout_login_module'		=> '1',
			'quickcheckout_html_header'			=> array(),
			'quickcheckout_html_footer'			=> array(),
			'quickcheckout_payment_module'		=> '1',
			'quickcheckout_payment_reload'		=> '0',
			'quickcheckout_payment'				=> '0',
			'quickcheckout_payment_logo'		=> array(),
			'quickcheckout_shipping_module'		=> '1',
			'quickcheckout_shipping'			=> '0',
			'quickcheckout_shipping_reload'		=> '0',
			'quickcheckout_shipping_logo'		=> array(),
			'quickcheckout_survey'			=> '1',
                        'quickcheckout_survey_type'		=> '1',
			'quickcheckout_survey_required'		=> '1',
                        'quickcheckout_survey_text'		=> '{"1":"Do you like our Quick Checkout module?"}',
                        'quickcheckout_survey_answers'		=> array(
                                                                        array(
                                                                        '1' => 'Yes'),
                                                                        array(
                                                                        '1' => 'No')
                        )


		);
				
		$this->model_setting_setting->editSetting('quickcheckout', $data);
                
		$this->load->model('setting/store');
		
		$stores = $this->model_setting_store->getStores();
		
		foreach ($stores as $store) {
			$this->model_setting_setting->editSetting('quickcheckout', $data, $store['store_id']);
		}
		
		// Layout
		if (!$this->getLayout()) {
			$this->load->model('design/layout');
			
			$layout_data = array(
				'name'			=> 'Quick Checkout',
				'layout_route'	=> array(
					array(
						'store_id'	=> 0,
						'route'		=> 'quickcheckout/checkout'
					)
				)
			);
			
			$this->model_design_layout->addLayout($layout_data);
		}
	}
	
	public function uninstall() {
		if (!$this->user->hasPermission('modify', 'extension/module')) {
			return;
		}
		
		if ($this->getLayout()) {
			$this->load->model('design/layout');
			
			$this->model_design_layout->deleteLayout($this->getLayout());
		}
	}
	
	private function getLayout() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "layout_route WHERE route = 'quickcheckout/checkout'");
		
		if ($query->num_rows) {
			return $query->row['layout_id'];
		}
		
		return false;
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/quickcheckout')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
        
}