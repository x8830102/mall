<?php
class ControllerModuleMVDFilter extends Controller {
	public function index() {
		if (isset($this->request->get['vpath'])) {
			$parts = explode('_', (string)$this->request->get['vpath']);
		} else {
			$parts = array();
		}

		$category_id = end($parts);

		$this->load->model('catalog/vdi_s_category');
		
		if (isset($this->request->get['vendor_id'])) {
			$vendor_id = $this->request->get['vendor_id'];
		} else {
			$vendor_id = '0';
		}

		if ($vendor_id > 0) {
			$category_info = $this->model_catalog_vdi_s_category->getCategory($category_id);
				
			if ($category_info) {
				$this->load->language('module/filter');

				$data['heading_title'] = $this->language->get('heading_title');

				$data['button_filter'] = $this->language->get('button_filter');

				$url = '';

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['action'] = str_replace('&amp;', '&', $this->url->link('module/vendorlogo/getStoreCategory', 'vendor_id=' . $vendor_id . '&vpath=' . $this->request->get['vpath'] . $url));

				if (isset($this->request->get['filter'])) {
					$data['filter_category'] = explode(',', $this->request->get['filter']);
				} else {
					$data['filter_category'] = array();
				}

				$data['filter_groups'] = array();

				$filter_groups = $this->model_catalog_vdi_s_category->getCategoryFilters($category_id);
				
				$fp = fopen('filter_groups.txt', 'w');
				fwrite($fp, serialize($filter_groups));
				fclose($fp);

				if ($filter_groups) {
					foreach ($filter_groups as $filter_group) {
						$childen_data = array();

						foreach ($filter_group['filter'] as $filter) {
							$filter_data = array(
								'filter_category_id' => $category_id,
								'filter_filter'      => $filter['filter_id']
							);

							$childen_data[] = array(
								'filter_id' => $filter['filter_id'],
								'name'      => $filter['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_vdi_s_category->getTotalProducts($filter_data) . ')' : '')
							);
						}

						$data['filter_groups'][] = array(
							'filter_group_id' => $filter_group['filter_group_id'],
							'name'            => $filter_group['name'],
							'filter'          => $childen_data
						);
					}

					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_filter.tpl')) {
						return $this->load->view($this->config->get('config_template') . '/template/module/mvd_filter.tpl', $data);
					} else {
						return $this->load->view('default/template/module/mvd_filter.tpl', $data);
					}
				}
			}
		}
	}
}