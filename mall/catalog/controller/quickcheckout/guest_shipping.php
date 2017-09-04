<?php
class ControllerQuickCheckoutGuestShipping extends Controller {
  	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));

		if (isset($this->session->data['shipping_address']['firstname'])) {
			$data['firstname'] = $this->session->data['shipping_address']['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->session->data['shipping_address']['lastname'])) {
			$data['lastname'] = $this->session->data['shipping_address']['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->session->data['shipping_address']['company'])) {
			$data['company'] = $this->session->data['shipping_address']['company'];
		} else {
			$data['company'] = '';
		}

		if (isset($this->session->data['shipping_address']['address_1'])) {
			$data['address_1'] = $this->session->data['shipping_address']['address_1'];
		} else {
			$data['address_1'] = '';
		}

		if (isset($this->session->data['shipping_address']['address_2'])) {
			$data['address_2'] = $this->session->data['shipping_address']['address_2'];
		} else {
			$data['address_2'] = '';
		}

		if (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} elseif (isset($this->session->data['payment_address']['postcode'])) {
			$data['postcode'] = $this->session->data['payment_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->session->data['shipping_address']['city'])) {
			$data['city'] = $this->session->data['shipping_address']['city'];
		} else {
			$data['city'] = '';
		}

		if (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} elseif (isset($this->session->data['payment_address']['country_id'])) {
			$data['country_id'] = $this->session->data['payment_address']['country_id'];
		} else {
			$country = $this->config->get('quickcheckout_field_country');

			$data['country_id'] = isset($country['default']) ? $country['default'] : 0;
		}

		if (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} elseif (isset($this->session->data['payment_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['payment_address']['zone_id'];
		} else {
			$zone = $this->config->get('quickcheckout_field_zone');

			$data['zone_id'] = isset($zone['default']) ? $zone['default'] : 0;
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();
		
		// Custom Fields
		$this->load->model('account/custom_field');
		
		if (!isset($this->session->data['guest']['customer_group_id'])) {
			$this->session->data['guest']['customer_group_id'] = $this->config->get('config_customer_group_id');
		}
		
		if (isset($this->request->get['customer_group_id'])) {
			$this->session->data['guest']['customer_group_id'] = $this->request->get['customer_group_id'];
		}

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->session->data['guest']['customer_group_id']);

		if (isset($this->session->data['shipping_address']['custom_field'])) {
			$data['address_custom_field'] = $this->session->data['shipping_address']['custom_field'];
		} else {
			$data['address_custom_field'] = array();
		}

		$fields = array(
			'firstname',
			'lastname',
			'company',
			'address_1',
			'address_2',
			'city',
			'postcode',
			'country',
			'zone'
		);

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
					'required'		=> '0',
					'placeholder'		=> '電話',
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
                
		
		$data['debug'] = $this->config->get('quickcheckout_debug');

		$sort_order = array();

		foreach ($fields as $key => $field) {
			$field_data = $fields2[$field];

			$data['field_' . $field] = $field_data;

			$sort_order[$key] = $field_data['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $fields);

		$data['fields'] = $fields;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/guest_shipping.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/quickcheckout/guest_shipping.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/quickcheckout/guest_shipping.tpl', $data));
		}
	}

	public function validate() {
		$this->load->language('checkout/checkout');
		$this->load->language('quickcheckout/checkout');

		$json = array();
		
		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('quickcheckout/checkout', '', true);
		}

		if (!$json) {
			$firstname = $this->config->get('quickcheckout_field_firstname');

			if (!empty($firstname['required'])) {
				if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
					$json['error']['firstname'] = $this->language->get('error_firstname');
				}
			}

			$lastname = $this->config->get('quickcheckout_field_lastname');

			if (!empty($lastname['required'])) {
				if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
					$json['error']['lastname'] = $this->language->get('error_lastname');
				}
			}

			$address_1 = $this->config->get('quickcheckout_field_address_1');

			if (!empty($address_1['required'])) {
				if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 128)) {
					$json['error']['address_1'] = $this->language->get('error_address_1');
				}
			}

			$address_2 = $this->config->get('quickcheckout_field_address_2');

			if (!empty($address_2['required'])) {
				if ((utf8_strlen($this->request->post['address_2']) < 3) || (utf8_strlen($this->request->post['address_2']) > 128)) {
					$json['error']['address_2'] = $this->language->get('error_address_2');
				}
			}

			$city = $this->config->get('quickcheckout_field_city');

			if (!empty($city['required'])) {
				if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
					$json['error']['city'] = $this->language->get('error_city');
				}
			}

			$company = $this->config->get('quickcheckout_field_company');

			if (!empty($company['required'])) {
				if ((utf8_strlen($this->request->post['company']) < 3) || (utf8_strlen($this->request->post['company']) > 32)) {
					$json['error']['company'] = $this->language->get('error_company');
				}
			}

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

                        $postcode = $this->config->get('quickcheckout_field_postcode');
                        
                        if (!empty($postcode['required'])) {
                                if ((utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
                                    $json['error']['postcode'] = $this->language->get('error_postcode');
                                }
                        }

		/*	if ($country_info && $country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
				$json['error']['postcode'] = $this->language->get('error_postcode');
			} */

			$country = $this->config->get('quickcheckout_field_country');

			if (!empty($country['required'])) {
				if ($this->request->post['country_id'] == '') {
					$json['error']['country'] = $this->language->get('error_country');
				}
			}

			$zone = $this->config->get('quickcheckout_field_zone');

			if (!empty($zone['required'])) {
				if ($this->request->post['zone_id'] == '') {
					$json['error']['zone'] = $this->language->get('error_zone');
				}
			}
			
			// Custom field validation
			$this->load->model('account/custom_field');
			
			if (!isset($this->session->data['guest']['customer_group_id'])) {
				$this->session->data['guest']['customer_group_id'] = $this->config->get('config_customer_group_id');
			}

			$custom_fields = $this->model_account_custom_field->getCustomFields($this->session->data['guest']['customer_group_id']);

			foreach ($custom_fields as $custom_field) {
				if (($custom_field['location'] == 'address') && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
					$json['error']['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
				}
			}
		}

		if (!$json) {
			// Newly registered customer add address
			if ($this->customer->isLogged()) {
				$this->load->model('account/address');

				$address_id = $this->model_account_address->addAddress($this->request->post);
			}
			
			$this->session->data['shipping_address']['firstname'] = $this->request->post['firstname'];
			$this->session->data['shipping_address']['lastname'] = $this->request->post['lastname'];
			$this->session->data['shipping_address']['company'] = $this->request->post['company'];
			$this->session->data['shipping_address']['address_1'] = $this->request->post['address_1'];
			$this->session->data['shipping_address']['address_2'] = $this->request->post['address_2'];
			$this->session->data['shipping_address']['postcode'] = $this->request->post['postcode'];
			$this->session->data['shipping_address']['city'] = $this->request->post['city'];
			$this->session->data['shipping_address']['country_id'] = $this->request->post['country_id'];
			$this->session->data['shipping_address']['zone_id'] = $this->request->post['zone_id'];

			$this->load->model('localisation/country');

			$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

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

			$this->load->model('localisation/zone');

			$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);

			if ($zone_info) {
				$this->session->data['shipping_address']['zone'] = $zone_info['name'];
				$this->session->data['shipping_address']['zone_code'] = $zone_info['code'];
			} else {
				$this->session->data['shipping_address']['zone'] = '';
				$this->session->data['shipping_address']['zone_code'] = '';
			}

			if (isset($this->request->post['custom_field'])) {
				$this->session->data['shipping_address']['custom_field'] = $this->request->post['custom_field']['address'];
			} else {
				$this->session->data['shipping_address']['custom_field'] = array();
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}