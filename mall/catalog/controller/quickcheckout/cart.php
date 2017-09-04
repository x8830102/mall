<?php 
class ControllerQuickCheckoutCart extends Controller {
	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));
		
		$this->load->model('extension/extension');
		
		$total_data = array();					
		$total = 0;
		$taxes = $this->cart->getTaxes();
		
		$total_data = array(
			'totals' => &$totals,
			'taxes'  => &$taxes,
			'total'  => &$total
		);
		
		if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
			$sort_order = array(); 
			
			$results = $this->model_extension_extension->getExtensions('total');
			
			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}
			
			array_multisort($sort_order, SORT_ASC, $results);
			
			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('total/' . $result['code']);
		
					$this->{'model_total_' . $result['code']}->getTotal($totals, $total, $taxes);
				}
			}
			
			$total_data = $totals;
				
			$sort_order = array(); 
		  
			foreach ($total_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $total_data);			
		}
		
		$data['totals'] = array();

		foreach ($total_data as $total) {
			$text = $this->currency->format($total['value'], $this->session->data['currency']);
			
			$data['totals'][] = array(
				'title' => $total['title'],
				'text'  => $text
			);
		}
		
		$this->load->model('tool/image');
		$this->load->model('tool/upload');
		
		$data['products'] = array();
		
		$products = $this->cart->getProducts();
			
		foreach ($products as $product) {
			$product_total = 0;

			foreach ($products as $product_2) {
				if ($product_2['product_id'] == $product['product_id']) {
					$product_total += $product_2['quantity'];
				}
			}

			if ($product['minimum'] > $product_total) {
				$data['error_warning'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
			}

			$option_data = array();

			foreach ($product['option'] as $option) {
				if ($option['type'] != 'file') {
					$value = $option['value'];
				} else {
					$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

					if ($upload_info) {
						$value = $upload_info['name'];
					} else {
						$value = '';
					}
				}

				$option_data[] = array(
					'name'  => $option['name'],
					'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
				);
			}

			if ($product['image']) {
				$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
			} else {
				$image = '';
			}
			
			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
			} else {
				$price = false;
			}

			// Display prices
			if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
				$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'], $this->session->data['currency']);
			} else {
				$total = false;
			}

			$recurring = '';

			if ($product['recurring']) {
				$frequencies = array(
					'day'        => $this->language->get('text_day'),
					'week'       => $this->language->get('text_week'),
					'semi_month' => $this->language->get('text_semi_month'),
					'month'      => $this->language->get('text_month'),
					'year'       => $this->language->get('text_year'),
				);
				
				if ($product['recurring']['trial']) {
					$recurring = sprintf($this->language->get('text_trial_description'), $this->currency->format($this->tax->calculate($product['recurring']['trial_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']), $product['recurring']['trial_cycle'], $frequencies[$product['recurring']['trial_frequency']], $product['recurring']['trial_duration']) . ' ';
				}

				if ($product['recurring']['duration']) {
					$recurring .= sprintf($this->language->get('text_payment_description'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
				} else {
					$recurring .= sprintf($this->language->get('text_payment_cancel'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
				}
			}

			$data['products'][] = array(
				'key'        => isset($product['key']) ? $product['key'] : $product['cart_id'],
				'thumb'     => $image,
				'name'      => $product['name'],
				'model'     => $product['model'],
				'option'    => $option_data,
				'recurring' => $recurring,
				'quantity'  => $product['quantity'],
				'stock'     => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
				'reward'    => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
				'price'     => $price,
				'total'     => $total,
				'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
			);
		}
		
		$data['vouchers'] = array();

		if (!empty($this->session->data['vouchers'])) {
			foreach ($this->session->data['vouchers'] as $key => $voucher) {
				$data['vouchers'][] = array(
					'key'         => $key,
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount']),
					'remove'      => $this->url->link('checkout/cart', 'remove=' . $key)
				);
			}
		}
		
		$data['text_survey'] = 'Do you like our Quick Checkout module?';
                
		if (isset($this->request->post['comment'])) {
			$data['comment'] = $this->request->post['comment'];
		} elseif (isset($this->session->data['order_comment'])) {
			$data['comment'] = $this->session->data['order_comment'];
		} else {
			$data['comment'] = '';
		}
		
		if (isset($this->request->post['survey'])) {
			$data['survey'] = $this->request->post['survey'];
		} elseif (isset($this->session->data['survey'])) {
			$data['survey'] = $this->session->data['survey'];
		} else {
			$data['survey'] = '';
		}
                
                $data['field_comment'] = $this->config->get('quickcheckout_field_comment');
		$data['survey_survey'] = '1';
		$data['survey_required'] = '1';
		$data['survey_type'] = '1';
		$data['survey_answers'] = $this->config->get('quickcheckout_survey_answers');
                $data['language_id'] = $this->config->get('config_language_id');
                
		$data['edit_cart'] = '1';
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/cart.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/quickcheckout/cart.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/quickcheckout/cart.tpl', $data));
		}
	}
	
	public function update() {
		$json = array();
		
		if (!empty($this->request->post['quantity'])) {
			foreach ($this->request->post['quantity'] as $key => $value) {
				$this->cart->update($key, $value);
			}
		}
		
		if (isset($this->request->get['remove'])) {
			$this->cart->remove($this->request->get['remove']);
			
			unset($this->session->data['vouchers'][$this->request->get['remove']]);
		}
		
		if ((!$this->cart->hasProducts() && empty($this->session->data['vouchers'])) || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}
		
		if ($this->cart->getTotal() < $this->config->get('quickcheckout_minimum_order')) {
			$json['redirect'] = $this->url->link('checkout/cart');
		}
                
		if (isset($this->request->post['survey'])) {
			$this->session->data['survey'] = strip_tags($this->request->post['survey']);
		}
		
		if (isset($this->request->post['comment'])) {
			$this->session->data['order_comment'] = strip_tags($this->request->post['comment']);
		}
                
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));	
	}
        
        public function validate() {
                
                $json = array();
            
		if ($this->config->get('quickcheckout_survey_required')) {
			if (empty($this->request->post['survey'])) {
				$json['error']['warning'] = $this->language->get('error_survey');
			}
		}
		
		$field_comment = $this->config->get('quickcheckout_field_comment');
                $survey_survey = $this->config->get('quickcheckout_survey');
			
		if (!empty($field_comment['required'])) {
			if (empty($this->request->post['comment'])) {
				$json['error']['warning'] = $this->language->get('error_comment');
			}
		}
            
            
		if (!$json) {
                    if (!empty($field_comment['display'])) {
			$this->session->data['order_comment'] = strip_tags($this->request->post['comment']);
                    }
                    if (!empty($survey_survey)) {
			$this->session->data['survey'] = strip_tags($this->request->post['survey']);
                    }
		}
                
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
                
        }
        
}