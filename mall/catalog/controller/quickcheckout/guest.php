<?php
class ControllerQuickCheckoutGuest extends Controller {
        protected $extension = 'checkout';
        
  	public function index() {
                $data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));

		$data['guest_checkout'] = ($this->config->get('config_checkout_guest') && !$this->config->get('config_customer_price') && !$this->cart->hasDownload());

		$data['customer_groups'] = array();

		if (is_array($this->config->get('config_customer_group_display'))) {
			$this->load->model('account/customer_group');

			$customer_groups = $this->model_account_customer_group->getCustomerGroups();

			foreach ($customer_groups as $customer_group) {
				if (in_array($customer_group['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$data['customer_groups'][] = $customer_group;
				}
			}
		}

		if (isset($this->session->data['guest']['customer_group_id'])) {
			$data['customer_group_id'] = $this->session->data['guest']['customer_group_id'];
		} else {
			$data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
		
		if (isset($this->session->data['guest']['firstname'])) {
			$data['firstname'] = $this->session->data['guest']['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->session->data['guest']['lastname'])) {
			$data['lastname'] = $this->session->data['guest']['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->session->data['guest']['email'])) {
			$data['email'] = $this->session->data['guest']['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->session->data['guest']['telephone'])) {
			$data['telephone'] = $this->session->data['guest']['telephone'];
		} else {
			$data['telephone'] = '';
		}


			$data['fax'] = '';



			$data['company'] = '';


		if (isset($this->session->data['payment_address']['address_1'])) {
			$data['address_1'] = $this->session->data['payment_address']['address_1'];
		} else {
			$data['address_1'] = '';
		}


			$data['address_2'] = '';



			$data['postcode'] = '';


		if (isset($this->session->data['payment_address']['city'])) {
			$data['city'] = $this->session->data['payment_address']['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->session->data['payment_address']['country_id'])) {
			$data['country_id'] = $this->session->data['payment_address']['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$country = $this->config->get('quickcheckout_field_country');

			$data['country_id'] = isset($country['default']) ? $country['default'] : 0;
		}

		if (isset($this->session->data['payment_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['payment_address']['zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$zone = $this->config->get('quickcheckout_field_zone');

			$data['zone_id'] = isset($zone['default']) ? $zone['default'] : 0;
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();
		
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields();

		if (isset($this->session->data['guest']['custom_field'])) {
			$data['guest_custom_field'] = $this->session->data['guest']['custom_field'] + $this->session->data['payment_address']['custom_field'];
		} else {
			$data['guest_custom_field'] = array();
		}

		$data['shipping_required'] = $this->cart->hasShipping();

		if (isset($this->session->data['guest']['shipping_address'])) {
			$data['shipping_address'] = $this->session->data['guest']['shipping_address'];
		} else {
			$data['shipping_address'] = true;
		}
		
		$field_register = $this->config->get('quickcheckout_field_register');
		
		if (isset($this->session->data['guest']['create_account'])) {
			$data['create_account'] = $this->session->data['guest']['create_account'];
		} elseif (!empty($field_register['default'])) {
			$data['create_account'] = true;
		} else {
			$data['create_account'] = false;
		}

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
			'zone'
		);

		$data['debug'] = 0;
		$data['field_register'] = $this->config->get('quickcheckout_field_register');

		$sort_order = array();

		$fields2 = array(
			'firstname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> '名字',
					'sort_order'	=> '2'
				),
			'lastname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> '姓氏',
					'sort_order'	=> '1'
				),
			'email'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> '電子郵件',
					'sort_order'	=> '3'
				),
			'telephone'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> '手機',
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
					'sort_order'	=> '14'
				),
			'address_1'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'		=> '地址',
					'sort_order'	=> '11'
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
					'placeholder'		=> '行政區',
					'sort_order'	=> '9'
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
					'display'		=> '1',
					'required'		=> '1',
					'default'		=> $this->config->get('config_zone_id'),
					'sort_order'	=> '8'
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
                
		foreach ($fields as $key => $field) {
                    
			$field_data = $fields2[$field];

			$data['field_' . $field] = $field_data;

			$sort_order[$key] = $field_data['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $fields);

		$data['fields'] = $fields;
		
		$data['register'] = $this->load->controller('quickcheckout/register');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/guest.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/quickcheckout/guest.tpl', $data);
		} else {
			return $this->load->view('default/template/quickcheckout/guest.tpl', $data);
		}
  	}

	public function validate() {
                $this->load->language('checkout/checkout');
                $this->load->language('quickcheckout/checkout');
                $this->load->model('setting/setting');

                if (isset($this->request->get['store_id'])) {
                        $store_id = $this->request->get['store_id'];
                } else {
                        $store_id = 0;
                }


		$json = array();

		// Validate if customer is logged in.
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('quickcheckout/checkout', '', true);
		}

		if (!$json) {

				if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
					$json['error']['firstname'] = $this->language->get('error_firstname');
				}

				if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
					$json['error']['lastname'] = $this->language->get('error_lastname');
				}


			if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
				$json['error']['email'] = $this->language->get('error_email');
			}


				if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
					$json['error']['address_1'] = $this->language->get('error_address_1');
				}


				if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
					$json['error']['city'] = $this->language->get('error_city');
				}

				if (utf8_strlen($this->request->post['telephone']) != 10) {
					$json['error']['telephone'] = $this->language->get('error_telephone');
				}




			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
        

/*			if ($country_info) {
				if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
					$json['error']['postcode'] = $this->language->get('error_postcode');
				}
			}   */


			// Customer Group
			if (isset($this->request->post['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->request->post['customer_group_id'], $this->config->get('config_customer_group_display'))) {
				$customer_group_id = $this->request->post['customer_group_id'];
			} else {
				$customer_group_id = $this->config->get('config_customer_group_id');
			}

			// Custom field validation
			$this->load->model('account/custom_field');

			$custom_fields = $this->model_account_custom_field->getCustomFields($customer_group_id);

			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'address' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
					$json['error']['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
				}
			}
		}

		if (!$json) {
			$this->session->data['account'] = 'guest';
			
			$this->session->data['guest']['customer_group_id'] = $customer_group_id;
			$this->session->data['guest']['firstname'] = $this->request->post['firstname'];
			$this->session->data['guest']['lastname'] = $this->request->post['lastname'];
			$this->session->data['guest']['email'] = $this->request->post['email'];
			$this->session->data['guest']['telephone'] = $this->request->post['telephone'];
			$this->session->data['guest']['fax'] = $this->request->post['fax'];

			if (isset($this->request->post['custom_field']['account'])) {
				$this->session->data['guest']['custom_field'] = $this->request->post['custom_field']['account'];
			} else {
				$this->session->data['guest']['custom_field'] = array();
			}

			$this->session->data['payment_address']['firstname'] = $this->request->post['firstname'];
			$this->session->data['payment_address']['lastname'] = $this->request->post['lastname'];
			$this->session->data['payment_address']['company'] = $this->request->post['company'];
			$this->session->data['payment_address']['address_1'] = $this->request->post['address_1'];
			$this->session->data['payment_address']['address_2'] = $this->request->post['address_2'];
			$this->session->data['payment_address']['postcode'] = $this->request->post['postcode'];
			$this->session->data['payment_address']['city'] = $this->request->post['city'];
			$this->session->data['payment_address']['country_id'] = $this->request->post['country_id'];
			$this->session->data['payment_address']['zone_id'] = $this->request->post['zone_id'];

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

			if ($country_info) {
				$this->session->data['payment_address']['country'] = $country_info['name'];
				$this->session->data['payment_address']['iso_code_2'] = $country_info['iso_code_2'];
				$this->session->data['payment_address']['iso_code_3'] = $country_info['iso_code_3'];
				$this->session->data['payment_address']['address_format'] = $country_info['address_format'];
			} else {
				$this->session->data['payment_address']['country'] = '';
				$this->session->data['payment_address']['iso_code_2'] = '';
				$this->session->data['payment_address']['iso_code_3'] = '';
				$this->session->data['payment_address']['address_format'] = '';
			}
			
			if (isset($this->request->post['custom_field']['address'])) {
				$this->session->data['payment_address']['custom_field'] = $this->request->post['custom_field']['address'];
			} else {
				$this->session->data['payment_address']['custom_field'] = array();
			}

			$this->load->model('localisation/zone');

			$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);

			if ($zone_info) {
				$this->session->data['payment_address']['zone'] = $zone_info['name'];
				$this->session->data['payment_address']['zone_code'] = $zone_info['code'];
			} else {
				$this->session->data['payment_address']['zone'] = '';
				$this->session->data['payment_address']['zone_code'] = '';
			}

			if (!empty($this->request->post['shipping_address'])) {
				$this->session->data['guest']['shipping_address'] = $this->request->post['shipping_address'];
			} else {
				$this->session->data['guest']['shipping_address'] = false;
			}

			// Default Payment Address
			if ($this->session->data['guest']['shipping_address']) {
				$this->session->data['shipping_address']['firstname'] = $this->request->post['firstname'];
				$this->session->data['shipping_address']['lastname'] = $this->request->post['lastname'];
				$this->session->data['shipping_address']['company'] = $this->request->post['company'];
				$this->session->data['shipping_address']['address_1'] = $this->request->post['address_1'];
				$this->session->data['shipping_address']['address_2'] = $this->request->post['address_2'];
				$this->session->data['shipping_address']['postcode'] = $this->request->post['postcode'];
				$this->session->data['shipping_address']['city'] = $this->request->post['city'];
				$this->session->data['shipping_address']['country_id'] = $this->request->post['country_id'];
				$this->session->data['shipping_address']['zone_id'] = $this->request->post['zone_id'];

				if ($country_info) {
					$this->session->data['shipping_address']['country'] = $country_info['name'];
					$this->session->data['shipping_address']['iso_code_2'] = $country_info['iso_code_2'];
					$this->session->data['shipping_address']['iso_code_3'] = $country_info['iso_code_3'];
					$this->session->data['shipping_address']['address_format'] = $country_info['address_format'];
				} else {
					$this->session->data['shipping_address']['country'] = '';
					$this->session->data['shipping_address']['iso_code_2'] = '';
					$this->session->data['shipping_address']['iso_code_3'] = '';
					$this->session->data['shipping_address']['address_format'] = '';
				}

				if ($zone_info) {
					$this->session->data['shipping_address']['zone'] = $zone_info['name'];
					$this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
				} else {
					$this->session->data['shipping_address']['zone'] = '';
					$this->session->data['shipping_address']['zone_code'] = '';
				}

				if (isset($this->request->post['custom_field']['address'])) {
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