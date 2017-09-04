<?php
class ControllerReportVDICategoryCommission extends Controller { 
	
	public function index() { 
		if ($this->config->get('mvd_com_cat_status')) {
			$this->load->language('report/vdi_category_commission');
			$this->document->setTitle($this->language->get('heading_title'));

			if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
			} else {
				$page = 1;
			}

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('report/vdi_category_commission', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);

			$data['categories'] = array();

			$filter_data = array(
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			
			$this->load->model('report/vdi_category_commission');
			
			$category_total = $this->model_report_vdi_category_commission->getTotalCategories();
			$results = $this->model_report_vdi_category_commission->getCategories($filter_data);

			foreach ($results as $result) {
			
				if (strpos($result['commission_rate'], '%') !== false) {
					$commission_rate = $result['commission_rate'];
				} else {
					$commission_rate = $this->currency->format($result['commission_rate']);
				}

				$data['categories'][] = array(
					'category_id' => $result['category_id'],
					'name'        => $result['name'],
					'commission'  => $commission_rate
				);
			}

			$data['heading_title'] = $this->language->get('heading_title');
			$data['text_list'] = $this->language->get('text_list');
			$data['text_no_results'] = $this->language->get('text_no_results');
			$data['column_name'] = $this->language->get('column_name');
			$data['column_commission'] = $this->language->get('column_commission');
			
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
			} else {
				$data['error_warning'] = '';
			}

			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$url = '';

			$pagination = new Pagination();
			$pagination->total = $category_total;
			$pagination->page = $page;
			$pagination->limit = $this->config->get('config_limit_admin');
			$pagination->url = $this->url->link('report/vdi_category_commission', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

			$data['pagination'] = $pagination->render();

			$data['results'] = sprintf($this->language->get('text_pagination'), ($category_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($category_total - $this->config->get('config_limit_admin'))) ? $category_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $category_total, ceil($category_total / $this->config->get('config_limit_admin')));

			$data['header'] = $this->load->controller('common/vdi_header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
			
			$this->response->setOutput($this->load->view('report/vdi_category_commission.tpl', $data));
		}
	}
}
?>