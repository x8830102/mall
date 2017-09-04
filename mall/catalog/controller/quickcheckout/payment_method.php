<?php  
class ControllerQuickCheckoutPaymentMethod extends Controller {
  	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));
		
		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		
		$payment_address = array();
		
		if ($this->customer->isLogged() && isset($this->request->get['address_id'])) {
			// Selected stored address
			$payment_address = $this->model_account_address->getAddress($this->request->get['address_id']);

			if (isset($this->session->data['guest'])) {
				unset($this->session->data['guest']);
			}
		} elseif (isset($this->request->post['country_id'])) {
			// Selected new address OR is a guest
			if (isset($this->request->post['country_id'])) {
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
			} else {
				$country_info = '';
			}
			
			if (isset($this->request->post['zone_id'])) {
				$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);
			} else {
				$zone_info = '';
			}
			
			if ($country_info) {
				$payment_address['country'] = $country_info['name'];
				$payment_address['iso_code_2'] = $country_info['iso_code_2'];
				$payment_address['iso_code_3'] = $country_info['iso_code_3'];
				$payment_address['address_format'] = $country_info['address_format'];
			} else {
				$payment_address['country'] = '';
				$payment_address['iso_code_2'] = '';
				$payment_address['iso_code_3'] = '';
				$payment_address['address_format'] = '';
			}
			
			if ($zone_info) {
				$payment_address['zone'] = $zone_info['name'];
				$payment_address['zone_code'] = $zone_info['code'];
			} else {
				$payment_address['zone'] = '';
				$payment_address['zone_code'] = '';
			}
		
			$payment_address['firstname'] = $this->request->post['firstname'];
			$payment_address['lastname'] = $this->request->post['lastname'];
			$payment_address['company'] = '';
			$payment_address['address_1'] = $this->request->post['address_1'];
			$payment_address['address_2'] = '';
			$payment_address['postcode'] = '';
			$payment_address['city'] = $this->request->post['city'];
			$payment_address['country_id'] = '222';
			$payment_address['zone_id'] = '';
		}
		
		if (!empty($payment_address)) {
			// Totals
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();
			
			$total_data = array(
				'totals' => &$totals,
				'taxes'  => &$taxes,
				'total'  => &$total
			);

			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			$method_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('payment');

			$recurring = $this->cart->hasRecurringProducts();

			$products = $this->cart->getProducts();

			//判斷是否需要貨到付款
			$check = false;
			foreach ($products as $products) {
				if ($products['shipping'] == '1') {
					$check = true;
				}
			}
			//拿掉貨到付款
			if(!$check){
				unset($results[5]);
			}
			foreach ($results as $result) {

				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('payment/' . $result['code']);

					$method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);

					if ($method) {
						if ($recurring) {
							if (property_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_payment_' . $result['code']}->recurringPayments()) {
								$method_data[$result['code']] = $method;
							}
						} else {
							$method_data[$result['code']] = $method;
						}
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			$this->session->data['payment_methods'] = $method_data;
		}
   
		if (empty($this->session->data['payment_methods'])) {
			$data['error_warning'] = sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact'));
		} else {
			$data['error_warning'] = '';
		}	

		if (isset($this->session->data['payment_methods'])) {
			$data['payment_methods'] = $this->session->data['payment_methods']; 
		} else {
			$data['payment_methods'] = array();
		}
	  
		if (isset($this->request->post['payment_method'])) {
			$data['code'] = $this->request->post['payment_method'];
		} elseif (isset($this->session->data['payment_method']['code'])) {
			$data['code'] = $this->session->data['payment_method']['code'];
		} else {
			$data['code'] = $this->config->get('quickcheckout_payment_default');
		}
		
		$exists = false;
		$stored_code = false;
		
		foreach ($data['payment_methods'] as $payment_method) {
			if (!$stored_code) {
				$stored_code = $payment_method['code'];
			}
			
			if ($payment_method['code'] == $data['code']) {
				$exists = true;
				
				break;
			}
		}

		if (!$exists) {
			$data['code'] = $stored_code;
		}
		

		$data['logged'] = $this->customer->isLogged();
		$data['debug'] = $this->config->get('quickcheckout_debug');
		$data['payment'] = '0';
		$data['payment_logo'] = $this->config->get('quickcheckout_payment_logo');
		$data['cart'] = $this->config->get('quickcheckout_cart');
		$data['payment_reload'] = $this->config->get('quickcheckout_payment_reload');
		$data['language_id'] = $this->config->get('config_language_id');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/payment_method.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/quickcheckout/payment_method.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/quickcheckout/payment_method.tpl', $data));
		}
  	}
	
	public function set() {
		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		
		if ($this->customer->isLogged() && isset($this->request->get['address_id'])) {
			// Selected stored address
			$this->session->data['payment_address_id'] = $this->request->get['address_id'];
						
			$this->session->data['payment_address'] = $this->model_account_address->getAddress($this->request->get['address_id']);
			
			if (isset($this->session->data['guest'])) {
				unset($this->session->data['guest']);
			}
		} elseif (isset($this->request->post['country_id'])) {
			// Selected new address OR is a guest
			if (isset($this->request->post['country_id'])) {
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
			} else {
				$country_info = '';
			}
			
			if (isset($this->request->post['zone_id'])) {
				$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);
			} else {
				$zone_info = '';
			}
			
			if ($country_info) {
				$payment_address['country'] = $country_info['name'];
				$payment_address['iso_code_2'] = $country_info['iso_code_2'];
				$payment_address['iso_code_3'] = $country_info['iso_code_3'];
				$payment_address['address_format'] = $country_info['address_format'];
			} else {
				$payment_address['country'] = '';
				$payment_address['iso_code_2'] = '';
				$payment_address['iso_code_3'] = '';
				$payment_address['address_format'] = '';
			}
			
			if ($zone_info) {
				$payment_address['zone'] = $zone_info['name'];
				$payment_address['zone_code'] = $zone_info['code'];
			} else {
				$payment_address['zone'] = '';
				$payment_address['zone_code'] = '';
			}
		
			$payment_address['firstname'] = $this->request->post['firstname'];
			$payment_address['lastname'] = $this->request->post['lastname'];
			$payment_address['company'] = $this->request->post['company'];
			$payment_address['address_1'] = $this->request->post['address_1'];
			$payment_address['address_2'] = $this->request->post['address_2'];
			$payment_address['postcode'] = $this->request->post['postcode'];
			$payment_address['city'] = $this->request->post['city'];
			$payment_address['country_id'] = $this->request->post['country_id'];
			$payment_address['zone_id'] = $this->request->post['zone_id'];
			
			$this->session->data['payment_address'] = $payment_address;
			$this->session->data['guest'] = $payment_address;
		}
		
		if (isset($this->request->post['payment_method']) && isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
			$this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payment_method']];
		}
	}
	
	public function validate() {
		$this->load->language('checkout/checkout');
		$this->load->language('quickcheckout/checkout');
		
		$this->load->model('account/address');
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		
		$json = array();
        
        // Set the address
        $payment_address = array();

		if (isset($this->session->data['payment_address'])) {
			$payment_address = $this->session->data['payment_address'];
		}
		
		// Validate if payment address has been set.
		if (empty($payment_address)) {
			$json['redirect'] = $this->url->link('quickcheckout/checkout', '', true);
		}
		
		if (!empty($payment_address)) {
			// Totals
			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();
			
			$total_data = array(
				'totals' => &$totals,
				'taxes'  => &$taxes,
				'total'  => &$total
			);

			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);

					$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
				}
			}

			// Payment Methods
			$method_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('payment');

			$recurring = $this->cart->hasRecurringProducts();

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('payment/' . $result['code']);

					$method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);

					if ($method) {
						if ($recurring) {
							if (property_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_payment_' . $result['code']}->recurringPayments()) {
								$method_data[$result['code']] = $method;
							}
						} else {
							$method_data[$result['code']] = $method;
						}
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			$this->session->data['payment_methods'] = $method_data;
		}
		
		if (!isset($this->request->post['payment_method'])) {
			$json['error']['warning'] = $this->language->get('error_payment');
		} elseif (!isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
			$json['error']['warning'] = $this->language->get('error_payment');
		}

		if (!$json) {
			$this->session->data['payment_method'] = $this->session->data['payment_methods'][$this->request->post['payment_method']];
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}