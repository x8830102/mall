<?php 
class ControllerQuickCheckoutVoucher extends Controller {
	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));
		
		$points_total = 0;
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['maxpoints']) {
				$points_total += $product['maxpoints'];
			}
		}
		
		if ($points_total && $this->customer->isLogged()) {
			$data['reward'] = true;
		} else {
			$data['reward'] = false;
		}
		
		// All variables
		$data['voucher_module'] = $this->config->get('quickcheckout_voucher');
		$data['coupon_module'] = $this->config->get('quickcheckout_coupon');
		$data['reward_module'] = $this->config->get('quickcheckout_reward');
		$data['points_tpl'] = $points_total;
		$data['telephone'] = $this->customer->getTelephone();

		if($this->customer->isLogged()){
			if(empty($data['telephone'])){

				?>
				<script>
				alert('請先設置聯絡手機!!');
				window.location = 'index.php?route=account/edit';		
				</script> <?php
			}else{ ?>
				<script>
				var a = "<?php echo $data['telephone'];?>";
				var b = /^09[0-9]{8}$/;
				if(b.test(a) != true){
					alert('聯繫電話不符手機格式!!');
					window.location = 'index.php?route=account/edit';		
				}
				</script>
		<?php }
		}
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/voucher.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/quickcheckout/voucher.tpl', $data);
		} else {
			return $this->load->view('default/template/quickcheckout/voucher.tpl', $data);
		}
	}
	
	public function validateCoupon() {
		$this->load->language('checkout/checkout');
		$this->load->language('quickcheckout/checkout');

		$json = array();
		
		if (!isset($this->request->post['coupon']) || empty($this->request->post['coupon'])) {
			$this->request->post['coupon'] = '';
			$this->session->data['coupon'] = '';
		}
		
		$this->load->model('checkout/coupon');
		
		$coupon_info = $this->model_checkout_coupon->getCoupon($this->request->post['coupon']);
		
		if (!$coupon_info) {			
			$json['error']['warning'] = $this->language->get('error_coupon');
		}
		
		if (!$json) {
			$this->session->data['coupon'] = $this->request->post['coupon'];
					
			$json['success'] = $this->language->get('text_coupon');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));		
	}
	
	public function validateVoucher() {
		$this->load->language('checkout/checkout');
		$this->load->language('quickcheckout/checkout');
		
		$json = array();
		
		if (!isset($this->request->post['voucher']) || empty($this->request->post['voucher'])) {
			$this->request->post['voucher'] = '';
			$this->session->data['voucher'] = '';
		}
		
		$this->load->model('checkout/voucher');
		
		$voucher_info = $this->model_checkout_voucher->getVoucher($this->request->post['voucher']);
		
		if (!$voucher_info) {
			$json['error']['warning'] = $this->language->get('error_voucher');
		}
		
		if (!$json) {
			$this->session->data['voucher'] = $this->request->post['voucher'];
					
			$json['success'] = $this->language->get('text_coupon');
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function validateReward() {
		$this->load->language('checkout/checkout');
		$this->load->language('quickcheckout/checkout');
		
		$points = $this->customer->getRewardPoints();
		
		$points_total = 0;
		
		foreach ($this->cart->getProducts() as $product) {
			if ($product['maxpoints']) {
				$points_total += $product['maxpoints'];
			}
		}	
		
		$json = array();
				
		/*if (empty($this->request->post['reward'])) {
			$json['error']['warning'] = $this->language->get('error_reward');
		}*/
	
		if ($this->request->post['reward'] > $points) {
			$json['error']['warning'] = sprintf($this->language->get('error_points'), $this->request->post['reward']);
		}
		
		if ($this->request->post['reward'] > $points_total) {
			$json['error']['warning'] = sprintf($this->language->get('error_maximum'), $points_total);
		}

		if ($this->request->post['reward'] < 0) {
			$json['error']['warning'] = sprintf($this->language->get('error_zero'));
		}
		
		if (!$json) {
			$this->session->data['reward'] = abs($this->request->post['reward']);
			
			$json['success'] = $this->language->get('text_reward');
		}	
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));	
	}
}