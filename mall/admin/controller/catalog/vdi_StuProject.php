<?php
class ControllerCatalogVDIStuProject extends Controller {

	public function index(){
		$this->load->language('catalog/vdi_StuProject');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/vdi_StuProject');
		
		$this->getList();
	}
	protected function getList(){
		$this->load->model('tool/image');
		
		$VendorInfortion = $this->model_catalog_vdi_StuProject->getVendor();
		$vendor_id = $VendorInfortion['vendor_id'];
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/vdi_StuProject', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['action'] = $this->url->link('catalog/vdi_StuProject/deleteProducts', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');
		
		
		$products = $this->model_catalog_vdi_StuProject->getProducts($vendor_id);
		foreach($products as $result)
		{
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}
			if(!empty($result['StuLevel'])){
				$data['products'][] = array(
				'image' => $image,
				'product_id' => $result['product_id'],
				'name'	=> $result['name'],
				'price' => $result['price'],
				'quantity' => $result['quantity']
				);
			}
		}
		$url = '';
		$data['add'] = $this->url->link("catalog/vdi_StuProject/add", 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('catalog/vdi_StuProject.tpl', $data));
	}
	protected function getForm(){
		$this->load->model('tool/image');
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/vdi_StuProject', 'token=' . $this->session->data['token'], 'SSL')
		);
		$data['text_add'] = $this->language->get('text_add');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_save'] = $this->language->get('button_save');
		
		$data['action'] = $this->url->link('catalog/vdi_StuProject/addProducts', 'token=' . $this->session->data['token'], 'SSL');

		
		$products = $this->model_catalog_vdi_StuProject->getAllProducts();
		foreach($products as $result)
		{
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}
			if(!empty($result['StuLevel'])){
				$data['products'][] = array(
				'image' => $image,
				'product_id' => $result['product_id'],
				'name'	=> $result['name'],
				'price' => $result['price'],
				'quantity' => $result['quantity']
				);
			}
		}
		$url = '';
		$data['cancel'] = $this->url->link("catalog/vdi_StuProject", 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('catalog/vdi_StuProject.tpl', $data));
	}
	
	
	public function add(){
		$this->load->language('catalog/vdi_StuProject');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('catalog/vdi_StuProject');
		
		
		$this->getForm();
	}
 
	public function addProducts(){
		
		$this->load->model('catalog/vdi_StuProject');
		
		$VendorInfortion = $this->model_catalog_vdi_StuProject->getVendor();
		$vendor_id = $VendorInfortion['vendor_id'];
		
		if(isset($this->request->post['selected'])){
			
			foreach($this->request->post['selected'] as $ProductId){
				
				$this->model_catalog_vdi_StuProject->addProducts($ProductId,$vendor_id);
			}
			$url ='';
			$this->response->redirect($this->url->link('catalog/vdi_StuProject', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	}
	
	public function deleteProducts(){
		$this->load->model('catalog/vdi_StuProject');
		
		$VendorInfortion = $this->model_catalog_vdi_StuProject->getVendor();
		$vendor_id = $VendorInfortion['vendor_id'];
		
		if(isset($this->request->post['selected'])){
			foreach($this->request->post['selected'] as $ProductId){
				$this->model_catalog_vdi_StuProject->deleteProducts($ProductId,$vendor_id);
			}
			$url ='';
			$this->response->redirect($this->url->link('catalog/vdi_StuProject', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
	}
}
?>