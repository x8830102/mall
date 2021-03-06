<?php 
class ControllerPaymentSuntech24Pay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/suntech_24pay');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('suntech_24pay', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');
			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');

        $data['entry_test_mode'] = $this->language->get('entry_test_mode');
		$data['entry_account'] = $this->language->get('entry_account');
		$data['entry_account_note'] = $this->language->get('entry_account_note');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_duedays'] = $this->language->get('entry_duedays');
		$data['entry_product_name'] = $this->language->get('entry_product_name');
		$data['entry_duedays_note'] = $this->language->get('entry_duedays_note');
		$data['entry_product_name_note'] = $this->language->get('entry_product_name_note');

        $data['entry_cargo'] = $this->language->get('entry_cargo');
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['account'])) {
			$data['error_account'] = $this->error['account'];
		} else {
			$data['error_account'] = '';
		}

 		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

 		if (isset($this->error['duedays'])) {
			$data['error_duedays'] = $this->error['duedays'];
		} else {
			$data['error_duedays'] = '';
		}

 		if (isset($this->error['product_name'])) {
			$data['error_product_name'] = $this->error['product_name'];
		} else {
			$data['error_product_name'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),       		
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/suntech_24pay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		# Set the form action
		$data['action'] = $this->url->link('payment/suntech_24pay', 'token=' . $this->session->data['token'], 'SSL');	
		# Set the cancel button
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['suntech_24pay_test_mode'])) {
            $data['suntech_24pay_test_mode'] = $this->request->post['suntech_24pay_test_mode'];
        } else {
            $data['suntech_24pay_test_mode'] = $this->config->get('suntech_24pay_test_mode');
        }

		if (isset($this->request->post['suntech_24pay_account'])) {
			$data['suntech_24pay_account'] = $this->request->post['suntech_24pay_account'];
		} else {
			$data['suntech_24pay_account'] = $this->config->get('suntech_24pay_account');
		}

		if (isset($this->request->post['suntech_24pay_password'])) {
			$data['suntech_24pay_password'] = $this->request->post['suntech_24pay_password'];
		} else {
			$data['suntech_24pay_password'] = $this->config->get('suntech_24pay_password');
		}

		if (isset($this->request->post['suntech_24pay_duedays'])) {
			$data['suntech_24pay_duedays'] = $this->request->post['suntech_24pay_duedays'];
		} else {
			$data['suntech_24pay_duedays'] = $this->config->get('suntech_24pay_duedays');
		}

		if (isset($this->request->post['suntech_24pay_product_name'])) {
			$data['suntech_24pay_product_name'] = $this->request->post['suntech_24pay_product_name'];
		} else {
			$data['suntech_24pay_product_name'] = $this->config->get('suntech_24pay_product_name');
		}

        if (isset($this->request->post['suntech_24pay_cargo_option'])) {
            $data['suntech_24pay_cargo_option'] = $this->request->post['suntech_24pay_cargo_option'];
        } else {
            $data['suntech_24pay_cargo_option'] = $this->config->get('suntech_24pay_cargo_option');
        }
        
		if (isset($this->request->post['suntech_24pay_order_status_id'])) {
			$data['suntech_24pay_order_status_id'] = $this->request->post['suntech_24pay_order_status_id'];
		} else {
			$data['suntech_24pay_order_status_id'] = $this->config->get('suntech_24pay_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['suntech_24pay_geo_zone_id'])) {
			$data['suntech_24pay_geo_zone_id'] = $this->request->post['suntech_24pay_geo_zone_id'];
		} else {
			$data['suntech_24pay_geo_zone_id'] = $this->config->get('suntech_24pay_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['suntech_24pay_status'])) {
			$data['suntech_24pay_status'] = $this->request->post['suntech_24pay_status'];
		} else {
			$data['suntech_24pay_status'] = $this->config->get('suntech_24pay_status');
		}
		
		if (isset($this->request->post['suntech_24pay_sort_order'])) {
			$data['suntech_24pay_sort_order'] = $this->request->post['suntech_24pay_sort_order'];
		} else {
			$data['suntech_24pay_sort_order'] = $this->config->get('suntech_24pay_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('payment/suntech_24pay.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/suntech_24pay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['suntech_24pay_account']) {
			$this->error['account'] = $this->language->get('error_account');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>