<?php
class ControllerModuleMVDCarousel extends Controller {
	public function index($setting) {
		static $module = 0;
		
		$this->language->load('module/vendorlogo');
		
		$this->load->model('design/banner');
		$this->load->model('tool/image');
		$this->load->model('catalog/vendorlogo');
		
		$this->document->addStyle('catalog/view/javascript/jquery/mvd-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/mvd-carousel/owl.carousel.min.js');
		
		$data['heading_title'] = $setting['name'];
		$data['text_select'] = $this->language->get('text_select');
		$data['button_more_vendors'] = $this->language->get('button_more_vendors');
		
		$data['banners'] = array();
		
		if ($this->config->get('mvd_logo_vendor_review')) {
			$data['review'] = true;
		} else {
			$data['review'] = false;
		}
		
		if ($this->model_catalog_vendorlogo->getAllVendor() == $setting['limit']) {
			$data['more_vendors_link'] = false;
		} else {
			$data['more_vendors_link'] = $this->url->link('module/vendorlogo/getVendors');
		}
		
		$getList = array();
		$vendors = array();
		
		if ($this->config->get('mvd_logo_vendors_selected')) {
			$vendors = array_slice($this->config->get('mvd_logo_vendors_selected'), 0, $setting['limit']);			
		} else {
			$getIDs = $this->model_catalog_vendorlogo->getDefaultVendorsID();
			if ($getIDs) {
				foreach ($getIDs as $getID) {
					$getList[] = $getID['vendor_id'];
				}
			}
			$vendors = array_slice($getList, 0, $setting['limit']);		
		}
		
		if ($vendors) {	
			foreach ($vendors as $vendor_id) {
				$result = $this->model_catalog_vendorlogo->getVendor($vendor_id);
				if ($result) {
					if ($result['vendor_image']) {
						$image = $this->model_tool_image->resize($result['vendor_image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('no_image.png', $setting['width'], $setting['height']);
					}
						
					$preBool = $this->model_catalog_vendorlogo->preCheck();					
					$rating = $this->model_catalog_vendorlogo->getVendorRating($vendor_id);
					$total_feedback = $this->model_catalog_vendorlogo->getTotalFeedback($vendor_id);

					if ($preBool) {
						$total_order = $this->model_catalog_vendorlogo->getTotalVendorOrders($vendor_id);
					} else {
						$total_order = $this->model_catalog_vendorlogo->getOldTotalVendorOrders($vendor_id);
					}			
							
					$data['banners'][] = array(
						'title' 		=> $result['vendor_name'],
						'image' 		=> $image,
						'vendor_id' 	=> (int)$result['vendor_id'],
						'rating'		=> $rating,
						'review'		=> $this->language->get('text_feedback') . ' (' . $total_feedback . ') | ' . $this->language->get('text_order') . ' (' . $total_order . ')',
						'link'  		=> $this->url->link('module/vendorlogo/visitstore', 'vendor_id=' . (int)$result['vendor_id'])
					);
				}
			}
			
		$data['module'] = $module++;
		
		if ($setting['mode'] == '1') {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_carousel.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/mvd_carousel.tpl', $data);
			} else {
				return $this->load->view('default/template/module/mvd_carousel.tpl', $data);
			}
		} elseif ($setting['mode'] == '2') {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_vendors_list.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/mvd_vendors_list.tpl', $data);
			} else {
				return $this->load->view('default/template/module/mvd_vendors_list.tpl', $data);
			}
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_combo.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/mvd_combo.tpl', $data);
			} else {
				return $this->load->view('default/template/module/mvd_carousel.tpl', $data);
			}
		}
			unset($data['banners']);
		}
	}
}