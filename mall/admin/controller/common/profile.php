<?php
class ControllerCommonProfile extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$this->load->model('user/user');
		$this->load->model('catalog/vendor');

		$this->load->model('tool/image');

		$user_info = $this->model_user_user->getUser($this->user->getId());
		$vendor_info = $this->model_catalog_vendor->getVendorProfile($this->user->getId());

		if($vendor_info) {
			$data['vendor_id'] = $vendor_info['vendor_id'];
		}

		if ($user_info) {
			$data['firstname'] = $user_info['firstname'];
			$data['lastname'] = $user_info['lastname'];
			$data['username'] = $user_info['username'];

			$data['user_group'] = $user_info['user_group'] ;

			if (is_file(DIR_IMAGE . $user_info['image'])) {
				$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
			} else {
				$data['image'] = $this->model_tool_image->resize('no_image.png', 45, 45);
			}
		} else {
			$data['username'] = '';
			$data['image'] = '';
		}

		return $this->load->view('common/profile.tpl', $data);
	}
}