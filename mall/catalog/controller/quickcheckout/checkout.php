<?php
class ControllerQuickCheckoutCheckout extends Controller {
	
	public function index() {
		$this->document->addScript('catalog/view/javascript/jquery/onepagecheckout/onepagecheckout.js');
		
		if ($this->config->get('quickcheckout_load_screen')) {
			$this->document->addScript('catalog/view/javascript/jquery/onepagecheckout/onepagecheckout.block.js');
		}
		
		$theme = $this->config->get('config_theme');
		
		if (file_exists(DIR_TEMPLATE . $theme . '/stylesheet/quickcheckout.css')) {
			$this->document->addStyle('catalog/view/theme/' . $theme . '/stylesheet/onepagecheckout.css');
		} else {
			$this->document->addStyle('catalog/view/theme/default/stylesheet/onepagecheckout.css');
		}

		$stylesheet = 'two';
		
		if (file_exists(DIR_TEMPLATE . $theme . '/stylesheet/onepagecheckout_' . $stylesheet . '.css')) {
			$data['stylesheet'] = 'catalog/view/theme/' . $theme . '/stylesheet/onepagecheckout_' . $stylesheet . '.css';
		} else {
			$data['stylesheet'] = 'catalog/view/theme/default/stylesheet/onepagecheckout_' . $stylesheet . '.css';
		}
		
		if ($this->config->get('quickcheckout_responsive')) {
			if (file_exists(DIR_TEMPLATE . $theme . '/stylesheet/onepagecheckout_mobile.css')) {
				$data['mobile_stylesheet'] = 'catalog/view/theme/' . $theme . '/stylesheet/onepagecheckout_mobile.css';
			} else {
				$data['mobile_stylesheet'] = 'catalog/view/theme/default/stylesheet/onepagecheckout_mobile.css';
			}
		} else {
			$data['mobile_stylesheet'] = '';
		}
		
                $stylesheet_theme = $this->config->get('theme_default_directory');
                //echo $stylesheet_theme;
                if ($stylesheet_theme == 'journal2') {
                    if (file_exists(DIR_TEMPLATE . $theme . '/stylesheet/onepagecheckout_journal.css')) {
                            $data['stylesheet_theme'] = 'catalog/view/theme/' . $theme . '/stylesheet/onepagecheckout_journal.css';
                    } else {
                            $data['stylesheet_theme'] = 'catalog/view/theme/default/stylesheet/onepagecheckout_journal.css';
                    } 
		}
                                
                if ($stylesheet_theme == 'fastor') {
                    if (file_exists(DIR_TEMPLATE . $theme . '/stylesheet/onepagecheckout_fastor.css')) {
                            $data['stylesheet_theme'] = 'catalog/view/theme/' . $theme . '/stylesheet/onepagecheckout_fastor.css';
                    } else {
                            $data['stylesheet_theme'] = 'catalog/view/theme/default/stylesheet/onepagecheckout_fastor.css';
                    } 
                }
                
                if ($stylesheet_theme == 'BurnEngine') {
                    if (file_exists(DIR_TEMPLATE . $theme . '/stylesheet/onepagecheckout_pavilion.css')) {
                            $data['stylesheet_theme'] = 'catalog/view/theme/' . $theme . '/stylesheet/onepagecheckout_pavilion.css';
                    } else {
                            $data['stylesheet_theme'] = 'catalog/view/theme/default/stylesheet/onepagecheckout_pavilion.css';
                    } 
                }
                
                
		if (!$this->config->get('quickcheckout_debug') || !isset($this->request->get['debug'])) {
			if (!$this->config->get('quickcheckout_status')) {
				$this->response->redirect($this->url->link('checkout/checkout', '', true));
			}
		}
		
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/onepagecheckout/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/onepagecheckout/bootstrap-datetimepicker.min.css');


		if ($this->config->get('klarna_account') || $this->config->get('klarna_invoice')) {
			$this->document->addScript('http://cdn.klarna.com/public/kitt/toc/v1.0/js/klarna.terms.min.js');
		}
		

		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
	  		$this->response->redirect($this->url->link('checkout/cart'));
    	}
		
			
		$products = $this->cart->getProducts();
				
		foreach ($products as $product) {
			$product_total = 0;
				
			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}		
			
			if ($product['minimum'] > $product_total) {
				$this->response->redirect($this->url->link('checkout/cart'));
			}				
		}
		
		$data = array_merge($data, $this->load->language('checkout/checkout'));
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));
		

		if ($this->cart->getTotal() < (float)$this->config->get('quickcheckout_minimum_order')) {
			$this->session->data['error'] = sprintf($this->language->get('error_minimum_order'), $this->currency->format($this->config->get('quickcheckout_minimum_order'), $this->session->data['currency']));
			
			$this->response->redirect($this->url->link('checkout/cart'));
		}
		
		$this->document->setTitle($this->language->get('heading_title')); 
		
		$data['breadcrumbs'] = array();

                $data['breadcrumbs'][] = array(
                        'text'      => $this->language->get('text_home'),
                                'href'      => $this->url->link('common/home')
                ); 

                $data['breadcrumbs'][] = array(
                        'text'      => $this->language->get('text_cart'),
                                'href'      => $this->url->link('checkout/cart')
                );

                $data['breadcrumbs'][] = array(
                        'text'      => $this->language->get('heading_title'),
                                'href'      => $this->url->link('quickcheckout/checkout', '', true)
                );
		
		if ($this->config->get('quickcheckout_html_header')) {
			$html_header = $this->config->get('quickcheckout_html_header');
			
			if (!empty($html_header[$this->config->get('config_language_id')])) {
				$data['html_header'] = html_entity_decode($html_header[$this->config->get('config_language_id')]);
			} else {
				$data['html_header'] = '';
			}
		} else {
			$data['html_header'] = '';
		}
		
		if ($this->config->get('quickcheckout_html_footer')) {
			$html_footer = $this->config->get('quickcheckout_html_footer');
			
			if (!empty($html_footer[$this->config->get('config_language_id')])) {
				$data['html_footer'] = html_entity_decode($html_footer[$this->config->get('config_language_id')]);
			} else {
				$data['html_footer'] = '';
			}
		} else {
			$data['html_footer'] = '';
		}
		
		$data['logged'] = $this->customer->isLogged();
		$data['shipping_required'] = $this->cart->hasShipping();
		$data['load_screen'] = $this->config->get('quickcheckout_load_screen');
		$data['loading_display'] = $this->config->get('quickcheckout_loading_display') ? 'true' : 'false';
		$data['edit_cart'] = 1;
		$data['highlight_error'] = $this->config->get('quickcheckout_highlight_error');
		$data['text_error'] = $this->config->get('quickcheckout_text_error');
		$data['quickcheckout_layout'] = $this->config->get('quickcheckout_layout');
		$data['slide_effect'] = 1;
		$data['debug'] = 0;
		$data['auto_submit'] = 0;
		$data['coupon_module'] = 1;
		$data['voucher_module'] = 1;
		$data['reward_module'] = 1;
		$data['cart_module'] = $this->config->get('quickcheckout_cart');
		$data['payment_module'] = $this->config->get('quickcheckout_payment_module');
		$data['shipping_module'] = 1;
		$data['login_module'] = $this->config->get('quickcheckout_login_module');
		$data['save_data'] = $this->config->get('quickcheckout_save_data');
                $data['custom_css_heading_background'] = $this->config->get('quickcheckout_custom_css_heading_background');
                $data['custom_css_heading_font'] = $this->config->get('quickcheckout_custom_css_heading_font');
                $data['custom_css_border_radius'] = $this->config->get('quickcheckout_custom_css_border_radius');
                $data['custom_css_border_color'] = $this->config->get('quickcheckout_custom_css_border_color');
		$data['custom_css'] = html_entity_decode($this->config->get('quickcheckout_custom_css'), ENT_QUOTES);
		$data['confirmation_page'] = $this->config->get('quickcheckout_confirmation_page');
		
		if (!$this->customer->isLogged()) {
			$data['guest'] = $this->load->controller('quickcheckout/guest');
			$data['guest_shipping'] = $this->load->controller('quickcheckout/guest_shipping');
			
			if ($this->config->get('quickcheckout_login_module')) {
				$data['login'] = $this->load->controller('quickcheckout/login');
			}
		} else {
			$data['payment_address'] = $this->load->controller('quickcheckout/payment_address');
			$data['shipping_address'] = $this->load->controller('quickcheckout/shipping_address');
		}
		
		$data['voucher'] = $this->load->controller('quickcheckout/voucher');
		$data['terms'] = $this->load->controller('quickcheckout/terms');
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/checkout.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/quickcheckout/checkout.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/quickcheckout/checkout.tpl', $data));
		}
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
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function customfield() {
		$json = array();

		$this->load->model('account/custom_field');

		// Customer Group
		if (isset($this->request->get['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->get['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $this->request->get['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

		foreach ($custom_fields as $custom_field) {
			$json[] = array(
				'custom_field_id' => $custom_field['custom_field_id'],
				'required'        => $custom_field['required']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function save() {
		$json = array();

		if (!$this->customer->isLogged() && isset($this->request->get['type'])) {
			if ($this->request->get['type'] == 'payment') {
				$this->session->data['guest']['firstname'] = $this->request->post['firstname'];
				$this->session->data['guest']['lastname'] = $this->request->post['lastname'];
				$this->session->data['guest']['email'] = $this->request->post['email'];
				$this->session->data['guest']['telephone'] = $this->request->post['telephone'];
				$this->session->data['guest']['fax'] = $this->request->post['fax'];
				$this->session->data['guest']['country_id'] = $this->request->post['country_id'];
				$this->session->data['guest']['zone_id'] = $this->request->post['zone_id'];
				$this->session->data['guest']['shipping_address'] = isset($this->request->post['shipping_address']) ? true : false;
				$this->session->data['guest']['create_account'] = isset($this->request->post['create_account']) ? true : false;
				
				$this->session->data['payment_address']['firstname'] = $this->request->post['firstname'];
				$this->session->data['payment_address']['lastname'] = $this->request->post['lastname'];
				$this->session->data['payment_address']['company'] = $this->request->post['company'];
				$this->session->data['payment_address']['address_1'] = $this->request->post['address_1'];
				$this->session->data['payment_address']['address_2'] = $this->request->post['address_2'];
				$this->session->data['payment_address']['postcode'] = $this->request->post['postcode'];
				$this->session->data['payment_address']['city'] = $this->request->post['city'];
				$this->session->data['payment_address']['country_id'] = $this->request->post['country_id'];
				$this->session->data['payment_address']['zone_id'] = $this->request->post['zone_id'];
				
				if (isset($this->request->post['custom_field']['address'])) {
					$this->session->data['payment_address']['custom_field'] = $this->request->post['custom_field']['address'];
				} else {
					$this->session->data['payment_address']['custom_field'] = array();
				}
			} else {
				$this->session->data['shipping_address']['firstname'] = $this->request->post['firstname'];
				$this->session->data['shipping_address']['lastname'] = $this->request->post['lastname'];
				$this->session->data['shipping_address']['company'] = $this->request->post['company'];
				$this->session->data['shipping_address']['address_1'] = $this->request->post['address_1'];
				$this->session->data['shipping_address']['address_2'] = $this->request->post['address_2'];
				$this->session->data['shipping_address']['postcode'] = $this->request->post['postcode'];
				$this->session->data['shipping_address']['city'] = $this->request->post['city'];
				$this->session->data['shipping_address']['country_id'] = $this->request->post['country_id'];
				$this->session->data['shipping_address']['zone_id'] = $this->request->post['zone_id'];
				
				if (isset($this->request->post['custom_field'])) {
					$this->session->data['shipping_address']['custom_field'] = $this->request->post['custom_field']['address'];
				} else {
					$this->session->data['shipping_address']['custom_field'] = array();
				}
			}
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}