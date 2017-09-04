<?php
class ControllerModuleMVDProfile extends Controller {
	public function index() {
		
		$this->language->load('module/mvd_profile');
		
		$this->load->model('tool/image');
		$this->load->model('catalog/mvd_box');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_vendor_name'] = $this->language->get('text_vendor_name');
		$data['text_company_name'] = $this->language->get('text_company_name');
		$data['text_company_id'] = $this->language->get('text_company_id');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_registered'] = $this->language->get('text_registered');
		
		$data['text_rating'] = $this->language->get('text_rating');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_url'] = $this->language->get('text_url');
		$data['text_name'] = $this->language->get('text_name');
		
		$data['text_location'] = $this->language->get('text_location');
		$data['text_address_1'] = $this->language->get('text_address_1');
		$data['text_address_2'] = $this->language->get('text_address_2');
		$data['text_postcode'] = $this->language->get('text_postcode');
		$data['text_city'] = $this->language->get('text_city');
		$data['text_zone'] = $this->language->get('text_zone');
		$data['text_country'] = $this->language->get('text_country');
		$data['text_geocode'] = $this->language->get('text_geocode');
		
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
			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/home')
			);

			$data['breadcrumbs'][] = array(
				'text'      => ucwords($info['vendor_name']),
				'href'      => $this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . $info['vendor_id']),			
				'separator' => $this->language->get('text_separator')
			);
			
			$this->document->setTitle(sprintf($this->language->get('heading_title'),$info['vendor_name']));
			$this->document->setDescription(utf8_substr(strip_tags(html_entity_decode($info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')));
			$this->document->setKeywords(sprintf($this->language->get('heading_title'),$info['vendor_name']));
			$this->document->addLink($this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . $info['vendor_id']), 'canonical');
			
			$this->load->model('localisation/country');
			$country = $this->model_localisation_country->getCountry($info['country_id']);
			
			$this->load->model('localisation/zone');
			$zone = $this->model_localisation_zone->getZone($info['zone_id']);
			
			$data['api_key'] = $this->config->get('mvd_box_gg_api_key');
			$data['vendor_name'] = $info['vendor_name'];
			$data['company_name'] = $info['company_name'];
			$data['company_id'] = $info['company_id'];
			$data['description'] = $info['description'];
			$data['registered'] = $info['registered'];
			$data['telephone'] = $info['telephone'];
			$data['fax'] = $info['fax'];
			$data['email'] = $info['email'];
			$data['url'] = $info['url'];
			$data['thumb'] = $info['image'];
			$data['name'] = $info['name'];
			$data['address_1'] = $info['address_1'];
			$data['address_2'] = $info['address_2'];
			$data['postcode'] = $info['postcode'];
			$data['city'] = $info['city'];
			$data['zone'] = $info['zone'];
			$data['country'] = $info['country'];
			$data['location']   = '<img src="image/flags/' . strtolower($country['iso_code_2']) . '.png" />' . ' ' . $country['name']  . ' (' . (isset($zone['name']) ? $zone['name'] : $this->language->get('text_none')) . ') (' . $info['city'] . ')';
			$data['geocode'] = $info['geocode'];
			
			
			if ($info['image']) {
				$image = $this->model_tool_image->resize($info['image'], '100', '100');
				} else {
				$image = $this->model_tool_image->resize('no_image.png', '100', '100');
			}

			$getTransaction = $this->model_catalog_mvd_box->getTotalVendorTransactions($info['vendor_id']);
			
			if ($info['registered']!='1970') {
				$registered = $this->language->get('text_open_since') . $info['registered'];
			} else {
				$registered = false;
			}
			
			$this->load->model('catalog/vendorlogo');
			$data['rating'] = $this->model_catalog_vendorlogo->getVendorRating((int)$info['vendor_id']);
			
			$data['title'] = $info['vendor_name'];
			$data['image'] = $image;
			$data['year']  = $registered;	
			$data['link']  = $href;
			
			if ($getTransaction) {
				$data['transactions'] = $this->language->get('text_transaction') . (isset($getTransaction['total']) ? $getTransaction['total'] : 0) . ' ' . $this->language->get('text_order') . ' (' . (isset($getTransaction['quantity']) ? $getTransaction['quantity'] : 0)  . $this->language->get('text_pieces') . ')';
			} else {
				$data['transactions'] = false;
			}

		}
		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		if ($info['vendor_id']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_profile.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/module/mvd_profile.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/module/mvd_profile.tpl', $data));
			}
		}
	}
}