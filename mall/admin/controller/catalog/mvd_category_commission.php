<?php
class ControllerCatalogMVDCategoryCommission extends Controller {
	private $error = array();

  	public function index() {
		$this->load->language('catalog/mvd_category_commission');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/mvd_category_commission');
		$this->load->model('catalog/category');

		$this->getForm();
  	}

  	public function update() {
    	$this->load->language('catalog/mvd_category_commission');

    	$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/mvd_category_commission');

    	if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			$this->model_catalog_mvd_category_commission->updateComCat($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('catalog/mvd_category_commission', 'token=' . $this->session->data['token'], 'SSL'));
		}

    	$this->getForm();
  	}

  	private function getForm() {
	
    	$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] = $this->language->get('text_edit');
		
		$data['column_category'] = $this->language->get('column_category');
		$data['column_commission'] = $this->language->get('column_commission');
		
		$data['entry_commission'] = $this->language->get('entry_commission');
		
		$data['button_add_category'] = $this->language->get('button_add_category');
		$data['button_remove'] = $this->language->get('button_remove');
    	$data['button_save'] = $this->language->get('button_save');
    	$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/mvd_category_commission', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('catalog/mvd_category_commission/update', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['cancel'] = $this->url->link('catalog/mvd_category_commission', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		$results = $this->model_catalog_category->getCategories();
		
		foreach ($results as $result) {
			$data['categories'][] = array(
				'category_id' => $result['category_id'],
				'name'        => $result['name']
			);
		}
		
		$categories_commission = $this->model_catalog_mvd_category_commission->getCategoryCommission();
		
		if (isset($this->request->post['commission_category'])) {
			$data['commission_categories'] = $this->request->post['commission_category'];
		} elseif (isset($categories_commission)) {
			$data['commission_categories'] = $categories_commission;
		} else {
			$data['commission_categories'] = array();
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/mvd_category_commission_form.tpl', $data));
  	}

  	private function validateForm() {
    	if (!$this->user->hasPermission('modify', 'catalog/mvd_category_commission')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
		
    	if (!$this->error) {
			return TRUE;
    	} else {
			if (!isset($this->error['warning'])) {
				$this->error['warning'] = $this->language->get('error_required_data');
			}
      		return FALSE;
    	}
  	}
}
?>