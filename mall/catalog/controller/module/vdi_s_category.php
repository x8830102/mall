<?php
class ControllerModuleVDISCategory extends Controller {
	public function index() {
		$this->load->language('module/mvd_category');		
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
			$info = $this->model_catalog_vdi_s_category->getInfoByVendorID($vendor_id);
		} else {
			$info = $this->model_catalog_vdi_s_category->getVendorInfo($product_id);
		}

		if (isset($this->request->get['vpath'])) {
			$parts = explode('_', (string)$this->request->get['vpath']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}
		
		if ($info['vendor_id'] > 0) {
			$this->load->model('catalog/product');

			$data['categories'] = array();

			$categories = $this->model_catalog_vdi_s_category->getCategories(0, $info['vendor_id']);
			
			if ($categories) {
				foreach ($categories as $category) {
					$children_data = array();

					if ($category['category_id'] == $data['category_id']) {
						$children = $this->model_catalog_vdi_s_category->getCategories($category['category_id'],$info['vendor_id']);

						foreach($children as $child) {
							$filter_data = array('filter_category_id' => $child['category_id'], 'filter_sub_category' => true);

							$children_data[] = array(
								'category_id' => $child['category_id'],
								'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_vdi_s_category->getTotalProducts($filter_data) . ')' : ''),
								'href' => $this->url->link('module/vendorlogo/getStoreCategory', 'vpath=' . $category['category_id'] . '_' . $child['category_id'] . '&vendor_id=' . $info['vendor_id'])
							);
						}
					}

					$filter_data = array(
						'filter_category_id'  => $category['category_id'],
						'filter_sub_category' => true
					);

					$data['categories'][] = array(
						'category_id' => $category['category_id'],
						'name'        => $category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_vdi_s_category->getTotalProducts($filter_data) . ')' : ''),
						'children'    => $children_data,
						'href'        => $this->url->link('module/vendorlogo/getStoreCategory', 'vpath=' . $category['category_id'] . '&vendor_id=' . $info['vendor_id'])
					);
				}

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/vdi_s_category.tpl')) {
					return $this->load->view($this->config->get('config_template') . '/template/module/vdi_s_category.tpl', $data);
				} else {
					return $this->load->view('default/template/module/vdi_s_category.tpl', $data);
				}
			}
		}
	}
}