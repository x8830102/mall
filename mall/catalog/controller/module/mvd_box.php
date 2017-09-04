<?php
class ControllerModuleMVDBox extends Controller {
	public function index() {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
			$user = $_POST['user'];
			$store = $_POST['store'];
			$s_name = $_POST['s_name'];
			$stmt = $pdo_cc->query("SELECT * FROM wp_users WHERE user_login = '$user'");
			$check = $stmt->fetch();
			if($check != ""){
				$stmt = $pdo_cc->query("SELECT * FROM fstore WHERE my_us = '$user' AND yu_us = '$store'");
				$check = $stmt->fetch();
				if($check == ""){
					$stmt = $pdo_cc->query("INSERT INTO fstore SET my_us = '$user', yu_us = '$store', s_name = '$s_name', date = NOW()");
				  	echo '追蹤成功!';
				}else{
					echo '已經追蹤過囉!';
				}
			}else{
				echo '請先開通妮可貓帳號!';
			}
		  exit;
		}else{
			$this->language->load('module/mvd_box');
			
			$this->load->model('design/banner');
			$this->load->model('catalog/mvd_box');
			$this->load->model('tool/image');
			
			$data['text_stars'] = $this->language->get('text_stars');
			$data['text_visit_store'] = $this->language->get('text_visit_store');
			$data['text_findme'] = $this->language->get('text_findme');
			
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
				$info = $this->model_catalog_mvd_box->getInfoByVendorID($vendor_id);
			} else {
				$info = $this->model_catalog_mvd_box->getVendorInfo($product_id);
			}
			
			$review = $this->db->query("SHOW COLUMNS FROM `".DB_PREFIX."review` LIKE 'vendor_id'");
			
			if (!$review->row) {
				$data['vl_installed'] = False;
				$href = '';
			} else {
				$data['vl_installed'] = True;
				$href = $this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . (int)$info['vendor_id']);
			}
		
			if ($info['vendor_id']) {
				$data['heading_title'] = $info['vendor_name'];
				
				if ($info['image']) {
					$image = $this->model_tool_image->resize($info['image'], '80', '80');
					} else {
					$image = $this->model_tool_image->resize('no_image.png', '80', '80');
				}
				
				if ($info['registered']!='1970') {
					$registered = $this->language->get('text_open_since') . $info['registered'];
				} else {
					$registered = false;
				}
				
				$this->load->model('catalog/vendorlogo');
				$data['rating'] = $this->model_catalog_vendorlogo->getVendorRating((int)$info['vendor_id']);
				
				$data['profile_link'] = $this->url->link('module/mvd_profile', 'vendor_id=' . (int)$info['vendor_id']);			
				$data['title'] = $info['vendor_name'];
				$data['image'] = $image;
				$data['year']  = $registered;	
				$data['link']  = $href;
				$data['user'] = $this->customer->getUsername();
				
			}
			
			if ($info['vendor_id']) {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_box.tpl')) {
					return $this->load->view($this->config->get('config_template') . '/template/module/mvd_box.tpl', $data);
				} else {
					return $this->load->view('default/template/module/mvd_box.tpl', $data);
				}
			}
		}
	}
}
