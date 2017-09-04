<?php
class ControllerModuleVendorLogo extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/vendorlogo');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('mvd_logo', $this->request->post);
						
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		
		$data['entry_vendor'] = $this->language->get('entry_vendor');
		$data['entry_vendors_image'] = $this->language->get('entry_vendors_image');
		$data['entry_product_image'] = $this->language->get('entry_product_image');
		$data['entry_infomation'] = $this->language->get('entry_infomation');
		$data['entry_review'] = $this->language->get('entry_review');
		$data['entry_image'] = $this->language->get('entry_image');
		
		$data['help_vendors_image'] = $this->language->get('help_vendors_image');
		$data['help_product_image'] = $this->language->get('help_product_image');
		$data['help_infomation'] = $this->language->get('help_infomation');
		$data['help_review'] = $this->language->get('help_review');
		$data['help_vendor'] = $this->language->get('help_vendor');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/vendorlogo', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/vendorlogo', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}

		$data['action'] = $this->url->link('module/vendorlogo', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['mvd_logo_vw_image'])) {
			$data['mvd_logo_vw_image'] = $this->request->post['mvd_logo_vw_image'];
		} else {
			$data['mvd_logo_vw_image'] = $this->config->get('mvd_logo_vw_image');
		}
		
		if (isset($this->request->post['mvd_logo_vh_image'])) {
			$data['mvd_logo_vh_image'] = $this->request->post['mvd_logo_vh_image'];
		} else {
			$data['mvd_logo_vh_image'] = $this->config->get('mvd_logo_vh_image');
		}
		
		if (isset($this->request->post['mvd_logo_pvw_image'])) {
			$data['mvd_logo_pvw_image'] = $this->request->post['mvd_logo_pvw_image'];
		} else {
			$data['mvd_logo_pvw_image'] = $this->config->get('mvd_logo_pvw_image');
		}
		
		if (isset($this->request->post['mvd_logo_pvh_image'])) {
			$data['mvd_logo_pvh_image'] = $this->request->post['mvd_logo_pvh_image'];
		} else {
			$data['mvd_logo_pvh_image'] = $this->config->get('mvd_logo_pvh_image');
		}
		
		if (isset($this->request->post['mvd_logo_vendor_information'])) {
			$data['mvd_logo_vendor_information'] = $this->request->post['mvd_logo_vendor_information'];
		} else {
			$data['mvd_logo_vendor_information'] = $this->config->get('mvd_logo_vendor_information');
		}
		
		if (isset($this->request->post['mvd_logo_vendor_review'])) {
			$data['mvd_logo_vendor_review'] = $this->request->post['mvd_logo_vendor_review'];
		} else {
			$data['mvd_logo_vendor_review'] = $this->config->get('mvd_logo_vendor_review');
		}
		
		if (isset($this->request->post['mvd_logo_vendors_selected'])) {
			$selected_vendor = $this->request->post['mvd_logo_vendors_selected'];
		} elseif ($this->config->get('mvd_logo_vendors_selected')) {
			$selected_vendor = $this->config->get('mvd_logo_vendors_selected');
		} else { 	
			$selected_vendor = array();
		}
		
		$this->load->model('module/vendorlogo');
		$data['selected_vendor'] = array();
		
		foreach ($selected_vendor as $vendor) {
			$vendor_info = $this->model_module_vendorlogo->getVendor($vendor);

			if ($vendor_info) {
				$data['selected_vendor'][] = array(
					'vendor_id'  => $vendor_info['vendor_id'],
					'name'       => $vendor_info['vendor_name']
				);
			}
		}
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/vendorlogo.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/vendorlogo')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['mvd_logo_vw_image'] || !$this->request->post['mvd_logo_pvw_image']) {
			$this->error['warning'] = $this->language->get('error_image');
		}
		
		if (!$this->request->post['mvd_logo_vh_image'] || !$this->request->post['mvd_logo_pvh_image']) {
			$this->error['warning'] = $this->language->get('error_image');
		}
		
		return !$this->error;
	}
	
	public function autocomplete() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('module/vendorlogo');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_module_vendorlogo->getVendorsName($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'vendor_id' => $result['vendor_id'],
					'name'       => strip_tags(html_entity_decode($result['vendor_name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}