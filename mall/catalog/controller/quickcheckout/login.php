<?php  
class ControllerQuickCheckoutLogin extends Controller { 
	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('quickcheckout/checkout'));
		
		$data['forgotten'] = $this->url->link('account/forgotten', '', true);
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/quickcheckout/login.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/quickcheckout/login.tpl', $data);
		} else {
			return $this->load->view('default/template/quickcheckout/login.tpl', $data);
		}
	}
	
	public function validate() {
		$this->load->language('checkout/checkout');
		$this->load->language('quickcheckout/checkout');
		include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$stmt = $pdo_cmg->prepare("SELECT m_email,m_username FROM memberdata WHERE  m_username = ?");
		$stmt->bindParam(1, $username);
		$username = $this->request->post['email'];
		$stmt-> execute();
		$check = $stmt->fetch();
		$pdo_cmg = NULL;
		
		$json = array();
		
		if ($this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('quickcheckout/checkout', '', true);			
		}
		
		if (!$json) {
			$this->load->model('account/customer');
			
			// Check how many login attempts have been made.
			$login_info = $this->model_account_customer->getLoginAttempts($check['m_email']);
					
			if ($login_info && ($login_info['total'] > $this->config->get('config_login_attempts')) && strtotime('-1 hour') < strtotime($login_info['date_modified'])) {
				$json['error']['warning'] = $this->language->get('error_attempts');
			}
			
			// Check if customer has been approved.
			$customer_info = $this->model_account_customer->getCustomerByEmail($check['m_email']);

			if ($customer_info && !$customer_info['approved']) {
				$json['error']['warning'] = $this->language->get('error_approved');
			}
			
			if (!$json) {
				if (!$this->customer->login($check['m_email'], $this->request->post['password'])) {
					$json['error']['warning'] = $this->language->get('error_login');
					
					$this->model_account_customer->addLoginAttempt($check['m_email']);
				} else {
					$this->model_account_customer->deleteLoginAttempts($check['m_email']);
					
					// Add to activity log
					if ($this->config->get('config_customer_activity')) {
						$this->load->model('account/activity');

						$activity_data = array(
							'customer_id' => $this->customer->getId(),
							'name'        => $this->customer->getLastName().$this->customer->getFirstName()
						);

						$this->model_account_activity->addActivity('login', $activity_data);
					}
				}
			}
		}
		
		if (!$json) {
			$json['redirect'] = $this->url->link('quickcheckout/checkout', '', true);
		}
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));		
	}
}