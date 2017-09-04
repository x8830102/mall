<?php 
class ControllerPaymentSuntechSunship extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/suntech_sunship');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('suntech_sunship', $this->request->post);				
			
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
			'href'      => $this->url->link('payment/suntech_sunship', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		# Set the form action
		$data['action'] = $this->url->link('payment/suntech_sunship', 'token=' . $this->session->data['token'], 'SSL');	
		# Set the cancel button
		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['suntech_sunship_test_mode'])) {
            $data['suntech_sunship_test_mode'] = $this->request->post['suntech_sunship_test_mode'];
        } else {
            $data['suntech_sunship_test_mode'] = $this->config->get('suntech_sunship_test_mode');
        }

		if (isset($this->request->post['suntech_sunship_account'])) {
			$data['suntech_sunship_account'] = $this->request->post['suntech_sunship_account'];
		} else {
			$data['suntech_sunship_account'] = $this->config->get('suntech_sunship_account');
		}

		if (isset($this->request->post['suntech_sunship_password'])) {
			$data['suntech_sunship_password'] = $this->request->post['suntech_sunship_password'];
		} else {
			$data['suntech_sunship_password'] = $this->config->get('suntech_sunship_password');
		}

		if (isset($this->request->post['suntech_sunship_order_status_id'])) {
			$data['suntech_sunship_order_status_id'] = $this->request->post['suntech_sunship_order_status_id'];
		} else {
			$data['suntech_sunship_order_status_id'] = $this->config->get('suntech_sunship_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['suntech_sunship_geo_zone_id'])) {
			$data['suntech_sunship_geo_zone_id'] = $this->request->post['suntech_sunship_geo_zone_id'];
		} else {
			$data['suntech_sunship_geo_zone_id'] = $this->config->get('suntech_sunship_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');
										
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['suntech_sunship_status'])) {
			$data['suntech_sunship_status'] = $this->request->post['suntech_sunship_status'];
		} else {
			$data['suntech_sunship_status'] = $this->config->get('suntech_sunship_status');
		}
		
		if (isset($this->request->post['suntech_sunship_sort_order'])) {
			$data['suntech_sunship_sort_order'] = $this->request->post['suntech_sunship_sort_order'];
		} else {
			$data['suntech_sunship_sort_order'] = $this->config->get('suntech_sunship_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('payment/suntech_sunship.tpl', $data));
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/suntech_sunship')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['suntech_sunship_account']) {
			$this->error['account'] = $this->language->get('error_account');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
