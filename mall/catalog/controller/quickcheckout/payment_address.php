
<?php
class ControllerQuickCheckoutPaymentAddress extends Controller {
        protected $extension = 'checkout';
        
	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));

		if (isset($this->session->data['payment_address']['address_id'])) {
			$data['address_id'] = $this->session->data['payment_address']['address_id'];
		} else {
			$data['address_id'] = $this->customer->getAddressId(); 
		}

		$data['addresses'] = array();

		$this->load->model('account/address');

		$data['addresses'] = $this->model_account_address->getAddresses();

		if (isset($this->session->data['payment_address']['country_id'])) {
			$data['country_id'] = $this->session->data['payment_address']['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$country = $this->config->get('quickcheckout_field_country');

			$data['country_id'] = $country['default'];
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
		
		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		if (isset($this->session->data['payment_address']['custom_field'])) {
			$data['payment_address_custom_field'] = $this->session->data['payment_address']['custom_field'];
		} else {
			$data['payment_address_custom_field'] = array();
		}

		// Fields
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
					'placeholder'	=> '名字',
					'sort_order'	=> '2'
				),
			'lastname'		=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'	=> '姓氏',
					'sort_order'	=> '1'
				),
			'email'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'	=> '信箱',
					'sort_order'	=> '3'
				),
			'telephone'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'	=> '電話',
					'sort_order'	=> '4'
				),
			'fax'			=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'	=> 'Fax',
					'sort_order'	=> '5'
				),
			'address_text'		=> array(
					'display'		=> '1',
					'required'		=> '0',
					'placeholder'	=> '',
					'sort_order'	=> '6'
				),
			'company'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'	=> '',
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
					'placeholder'	=> '地址',
					'sort_order'	=> '11'
				),
			'address_2'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'	=> 'Additional Address',
					'sort_order'	=> '10'
				),
			'city'			=> array(
					'display'		=> '1',
					'required'		=> '1',
					'placeholder'	=> '行政區',
					'sort_order'	=> '9'
				),
			'postcode'		=> array(
					'display'		=> '0',
					'required'		=> '0',
					'placeholder'	=> 'Post Code',
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
					'placeholder'	=> '訂單備註',
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

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/payment_address.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/quickcheckout/payment_address.tpl', $data);
		} else {
			return $this->load->view('default/template/quickcheckout/payment_address.tpl', $data);
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


		if (!$this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('quickcheckout/checkout', '', true);
		}

		if (!$json) {
			if (isset($this->request->post['payment_address']) && $this->request->post['payment_address'] == 'existing') {
				$this->load->model('account/address');

				if (empty($this->request->post['address_id'])) {
					$json['error']['warning'] = $this->language->get('error_address');
				} elseif (!$this->model_account_address->getAddress($this->request->post['address_id'])) {
					$json['error']['warning'] = $this->language->get('error_address');
				}

				if (!$json) {
					// Default Payment Address
					$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->request->post['address_id']);
				}
			}

			if ($this->request->post['payment_address'] == 'new') {

					if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
						$json['error']['firstname'] = $this->language->get('error_firstname');
					}


					if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
						$json['error']['lastname'] = $this->language->get('error_lastname');
					}




					if ((utf8_strlen($this->request->post['address_1']) < 3) || (utf8_strlen($this->request->post['address_1']) > 64)) {
						$json['error']['address_1'] = $this->language->get('error_address_1');
					}


					if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
						$json['error']['city'] = $this->language->get('error_city');
					}


                                
			/*	if ($country_info) {
					if ($country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
						$json['error']['postcode'] = $this->language->get('error_postcode');
					}
				}   */




				$this->load->model('account/custom_field');

				$custom_fields = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

				foreach ($custom_fields as $custom_field) {
					if ($custom_field['location'] == 'address' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
						$json['error']['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
					}
				}

				if (!$json) {

					$this->load->model('account/address');
					
					$address_id = $this->model_account_address->addAddress($this->request->post);

					$this->session->data['payment_address'] = $this->model_account_address->getAddress($address_id);

					if ($this->config->get('config_customer_activity')) {
						$this->load->model('account/activity');

						$activity_data = array(
							'customer_id' => $this->customer->getId(),
							'name'        => $this->customer->getLastName().$this->customer->getFirstName()
						);

						$this->model_account_activity->addActivity('address_add', $activity_data);
					}
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}