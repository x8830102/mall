<?php 
class ControllerPaymentSuntechUnionpay extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/suntech_unionpay');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('suntech_unionpay', $this->request->post);				
			
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
		$data['entry_callback'] = $this->language->get('entry_callback');
		$data['entry_callback_note'] = $this->language->get('entry_callback_note');

//        $data['entry_cargo'] = $this->language->get('entry_cargo');
		$data['entry_order_status'] = $this->language->get('entry_order_status');		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['tab_general'] = $this->language->get('tab_general');

		$data['entry_success'] = $this->language->get('entry_success');
		$data['entry_success_note'] = $this->language->get('entry_success_note');
		$data['entry_error'] = $this->language->get('entry_error');
		$data['entry_error_note'] = $this->language->get('entry_error_note');

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
			'href'      => $this->url->link('payment/suntech_unionpay', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('payment/suntech_unionpay', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['suntech_unionpay_test_mode'])) {
            $data['suntech_unionpay_test_mode'] = $this->request->post['suntech_unionpay_test_mode'];
        } else {
            $data['suntech_unionpay_test_mode'] = $this->config->get('suntech_unionpay_test_mode');
        }

		if (isset($this->request->post['suntech_unionpay_account'])) {
			$data['suntech_unionpay_account'] = $this->request->post['suntech_unionpay_account'];
		} else {
			$data['suntech_unionpay_account'] = $this->config->get('suntech_unionpay_account');
		}

		if (isset($this->request->post['suntech_unionpay_password'])) {
			$data['suntech_unionpay_password'] = $this->request->post['suntech_unionpay_password'];
		} else {
			$data['suntech_unionpay_password'] = $this->config->get('suntech_unionpay_password');
		}

//        if (isset($this->request->post['suntech_unionpay_cargo_option'])) {
//            $data['suntech_unionpay_cargo_option'] = $this->request->post['suntech_unionpay_cargo_option'];
//        } else {
//            $data['suntech_unionpay_cargo_option'] = $this->config->get('suntech_unionpay_cargo_option');
//        }
        
		if (isset($this->request->post['suntech_unionpay_order_status_id'])) {
			$data['suntech_unionpay_order_status_id'] = $this->request->post['suntech_unionpay_order_status_id'];
		} else {
			$data['suntech_unionpay_order_status_id'] = $this->config->get('suntech_unionpay_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['suntech_unionpay_geo_zone_id'])) {
			$data['suntech_unionpay_geo_zone_id'] = $this->request->post['suntech_unionpay_geo_zone_id'];
		} else {
			$data['suntech_unionpay_geo_zone_id'] = $this->config->get('suntech_unionpay_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['suntech_unionpay_status'])) {
			$data['suntech_unionpay_status'] = $this->request->post['suntech_unionpay_status'];
		} else {
			$data['suntech_unionpay_status'] = $this->config->get('suntech_unionpay_status');
		}
		
		if (isset($this->request->post['suntech_unionpay_sort_order'])) {
			$data['suntech_unionpay_sort_order'] = $this->request->post['suntech_unionpay_sort_order'];
		} else {
			$data['suntech_unionpay_sort_order'] = $this->config->get('suntech_unionpay_sort_order');
		}

	
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('payment/suntech_unionpay.tpl', $data));

	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/suntech_unionpay')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['suntech_unionpay_account']) {
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