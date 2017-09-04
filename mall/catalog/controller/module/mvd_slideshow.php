<?php
class ControllerModuleMVDSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->model('design/mvd_banner');
		$this->load->model('tool/image');

		$data['banners'] = array();
		
		if (isset($this->request->get['vendor_id'])) {
			$vendor_id = (int)$this->request->get['vendor_id'];
		} else {
			$vendor_id = '0';
		}

		if ($vendor_id > 0) {
			
			$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/mvd_owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
			
			$results = $this->model_design_mvd_banner->getBanner($setting['banner_id'],$vendor_id);
			
			if ($results) {
				$i=0;
				foreach ($results as $result) {
				
					if ($result['banner_width']) {
						$b_width = $result['banner_width'];
					} else {
						$b_width = $setting['width'];
					}
					
					if ($result['banner_height']) {
						$b_height = $result['banner_height'];
					} else {
						$b_height = $setting['height'];
					}

					if (is_file(DIR_IMAGE . $result['image'])) {
						$data['banners'][] = array(
							'title' => $result['title'],
							'link'  => $result['link'],
							'image' => $this->model_tool_image->resize($result['image'], $b_width, $b_height)
						);					
						$i++;
					}
				}

				$data['module'] = $module++;
				
				if ($i > 1) {
					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_slideshow.tpl')) {
						return $this->load->view($this->config->get('config_template') . '/template/module/mvd_slideshow.tpl', $data);
					} else {
						return $this->load->view('default/template/module/mvd_slideshow.tpl', $data);
					}
				} else {
					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/mvd_html.tpl')) {
						return $this->load->view($this->config->get('config_template') . '/template/module/mvd_html.tpl', $data);
					} else {
						return $this->load->view('default/template/module/mvd_html.tpl', $data);
					}
				}
			}
		}
	}
}
