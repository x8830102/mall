<?php
class ControllerModuleMVDSearchFilter extends Controller {
	public function index() {
		$this->load->language('module/mvd_search_filter');
		$this->load->model('catalog/vdi_s_category'); 
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		if (isset($this->request->get['product_id'])) {
			$product_id = (int)$this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		
		if (isset($this->request->get['vendor_id'])) {
			$vendor_id = (int)$this->request->get['vendor_id'];
		} else {
			$vendor_id = '0';
		}
		
		if ($vendor_id > 0) {	
			$vendor = $vendor_id;
		} else {  
			$info = $this->model_catalog_vdi_s_category->getVendorInfo($product_id);
			$vendor = $info['vendor_id'];
		}
		
		if ($vendor > 0) {
			$data['vendor_id'] = $vendor;
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_search_filter.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/mvd_search_filter.tpl', $data);
			} else {
				return $this->load->view('default/template/module/mvd_search_filter.tpl', $data);
			}
		}
	}
}