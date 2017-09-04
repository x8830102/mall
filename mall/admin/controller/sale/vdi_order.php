<?php
class ControllerSaleVDIOrder extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('sale/vdi_order');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/vdi_order');

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = $this->request->get['filter_order_id'];
		} else {
			$filter_order_id = null;
		}

		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}

		if (isset($this->request->get['filter_order_status'])) {
			$filter_order_status = $this->request->get['filter_order_status'];
		} else {
			$filter_order_status = null;
		}

		if (isset($this->request->get['filter_total'])) {
			$filter_total = $this->request->get['filter_total'];
		} else {
			$filter_total = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$filter_date_modified = $this->request->get['filter_date_modified'];
		} else {
			$filter_date_modified = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'o.order_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

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
			'href' => $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['invoice'] = $this->url->link('sale/vdi_order/invoice', 'token=' . $this->session->data['token'], 'SSL');
		$data['shipping'] = $this->url->link('sale/vdi_order/shipping', 'token=' . $this->session->data['token'], 'SSL');

		$data['orders'] = array();

		$filter_data = array(
			'filter_order_id'      => $filter_order_id,
			'filter_customer'	   => $filter_customer,
			'filter_order_status'  => $filter_order_status,
			'filter_total'         => $filter_total,
			'filter_date_added'    => $filter_date_added,
			'filter_date_modified' => $filter_date_modified,
			'sort'                 => $sort,
			'order'                => $order,
			'start'                => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'                => $this->config->get('config_limit_admin')
		);

		$order_total = $this->model_sale_vdi_order->getTotalOrders($filter_data);

		$results = $this->model_sale_vdi_order->getOrders($filter_data);

		foreach ($results as $result) {
			$data['orders'][] = array(
				'order_id'      => $result['order_id'],
				'customer'      => $result['customer'],
				'status'        => $this->model_sale_vdi_order->getOrderStatusName($this->model_sale_vdi_order->getVendorOrderStatus($result['order_id'])),
				'total'         => $this->currency->format($result['total'] + $result['shipping_cost'] - $result['coupon_amount'] + ($this->config->get('tax_status') ? ($result['tax'] + $result['shipping_tax'] - $result['coupon_tax'] ) : 0), $result['currency_code'], $result['currency_value']),
				'date_added'    => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified' => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'shipping_code' => $result['shipping_code'],
				'view'          => $this->url->link('sale/vdi_order/info', 'token=' . $this->session->data['token'] . '&order_id=' . $result['order_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		$data['text_missing'] = $this->language->get('text_missing');

		$data['column_order_id'] = $this->language->get('column_order_id');
		$data['column_customer'] = $this->language->get('column_customer');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_date_modified'] = $this->language->get('column_date_modified');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_return_id'] = $this->language->get('entry_return_id');
		$data['entry_order_id'] = $this->language->get('entry_order_id');
		$data['entry_customer'] = $this->language->get('entry_customer');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_date_added'] = $this->language->get('entry_date_added');
		$data['entry_date_modified'] = $this->language->get('entry_date_modified');

		$data['button_invoice_print'] = $this->language->get('button_invoice_print');
		$data['button_shipping_print'] = $this->language->get('button_shipping_print');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['button_view'] = $this->language->get('button_view');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_order'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&sort=o.order_id' . $url, 'SSL');
		$data['sort_customer'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$data['sort_total'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&sort=o.date_added' . $url, 'SSL');
		$data['sort_date_modified'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_total'])) {
			$url .= '&filter_total=' . $this->request->get['filter_total'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $order_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($order_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($order_total - $this->config->get('config_limit_admin'))) ? $order_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $order_total, ceil($order_total / $this->config->get('config_limit_admin')));

		$data['filter_order_id'] = $filter_order_id;
		$data['filter_customer'] = $filter_customer;
		$data['filter_order_status'] = $filter_order_status;
		$data['filter_total'] = $filter_total;
		$data['filter_date_added'] = $filter_date_added;
		$data['filter_date_modified'] = $filter_date_modified;

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/vdi_header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/vdi_order_list.tpl', $data));
	}

	public function info() {
		$this->load->model('sale/vdi_order');

		if (isset($this->request->get['order_id'])) {
			$order_id = $this->request->get['order_id'];
		} else {
			$order_id = 0;
		}
		
		$this->createInvoiceNo2($order_id);
		$order_info = $this->model_sale_vdi_order->getOrder($order_id);
		$sales_status = $this->model_sale_vdi_order->SaleOrderValidate($order_id);
		
		if ($order_info && $sales_status) {
			$this->load->language('sale/vdi_order');

			$this->document->setTitle($this->language->get('heading_title'));
			
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_order_id'] = $this->language->get('text_order_id');
			$data['text_invoice_no'] = $this->language->get('text_invoice_no');
			$data['text_invoice_date'] = $this->language->get('text_invoice_date');
			$data['text_store_name'] = $this->language->get('text_store_name');
			$data['text_store_url'] = $this->language->get('text_store_url');
			$data['text_customer'] = $this->language->get('text_customer');
			$data['text_customer_group'] = $this->language->get('text_customer_group');
			$data['text_email'] = $this->language->get('text_email');
			$data['text_telephone'] = $this->language->get('text_telephone');
			$data['text_fax'] = $this->language->get('text_fax');
			$data['text_subtotal'] = $this->language->get('text_subtotal');
			$data['text_total'] = $this->language->get('text_total');
			$data['text_reward'] = $this->language->get('text_reward');
			$data['text_order_status'] = $this->language->get('text_order_status');
			$data['text_comment'] = $this->language->get('text_comment');
			$data['text_affiliate'] = $this->language->get('text_affiliate');
			$data['text_commission'] = $this->language->get('text_commission');
			$data['text_ip'] = $this->language->get('text_ip');
			$data['text_forwarded_ip'] = $this->language->get('text_forwarded_ip');
			$data['text_user_agent'] = $this->language->get('text_user_agent');
			$data['text_accept_language'] = $this->language->get('text_accept_language');
			$data['text_date_added'] = $this->language->get('text_date_added');
			$data['text_date_modified'] = $this->language->get('text_date_modified');
			$data['text_firstname'] = $this->language->get('text_firstname');
			$data['text_lastname'] = $this->language->get('text_lastname');
			$data['text_company'] = $this->language->get('text_company');
			$data['text_address_1'] = $this->language->get('text_address_1');
			$data['text_address_2'] = $this->language->get('text_address_2');
			$data['text_city'] = $this->language->get('text_city');
			$data['text_postcode'] = $this->language->get('text_postcode');
			$data['text_zone'] = $this->language->get('text_zone');
			$data['text_zone_code'] = $this->language->get('text_zone_code');
			$data['text_country'] = $this->language->get('text_country');
			$data['text_shipping_method'] = $this->language->get('text_shipping_method');
			$data['text_payment_method'] = $this->language->get('text_payment_method');
			$data['text_history'] = $this->language->get('text_history');
			$data['text_country_match'] = $this->language->get('text_country_match');
			$data['text_country_code'] = $this->language->get('text_country_code');
			$data['text_high_risk_country'] = $this->language->get('text_high_risk_country');
			$data['text_distance'] = $this->language->get('text_distance');
			$data['text_ip_region'] = $this->language->get('text_ip_region');
			$data['text_ip_city'] = $this->language->get('text_ip_city');
			$data['text_ip_latitude'] = $this->language->get('text_ip_latitude');
			$data['text_ip_longitude'] = $this->language->get('text_ip_longitude');
			$data['text_ip_isp'] = $this->language->get('text_ip_isp');
			$data['text_ip_org'] = $this->language->get('text_ip_org');
			$data['text_ip_asnum'] = $this->language->get('text_ip_asnum');
			$data['text_ip_user_type'] = $this->language->get('text_ip_user_type');
			$data['text_ip_country_confidence'] = $this->language->get('text_ip_country_confidence');
			$data['text_ip_region_confidence'] = $this->language->get('text_ip_region_confidence');
			$data['text_ip_city_confidence'] = $this->language->get('text_ip_city_confidence');
			$data['text_ip_postal_confidence'] = $this->language->get('text_ip_postal_confidence');
			$data['text_ip_postal_code'] = $this->language->get('text_ip_postal_code');
			$data['text_ip_accuracy_radius'] = $this->language->get('text_ip_accuracy_radius');
			$data['text_ip_net_speed_cell'] = $this->language->get('text_ip_net_speed_cell');
			$data['text_ip_metro_code'] = $this->language->get('text_ip_metro_code');
			$data['text_ip_area_code'] = $this->language->get('text_ip_area_code');
			$data['text_ip_time_zone'] = $this->language->get('text_ip_time_zone');
			$data['text_ip_region_name'] = $this->language->get('text_ip_region_name');
			$data['text_ip_domain'] = $this->language->get('text_ip_domain');
			$data['text_ip_country_name'] = $this->language->get('text_ip_country_name');
			$data['text_ip_continent_code'] = $this->language->get('text_ip_continent_code');
			$data['text_ip_corporate_proxy'] = $this->language->get('text_ip_corporate_proxy');
			$data['text_anonymous_proxy'] = $this->language->get('text_anonymous_proxy');
			$data['text_proxy_score'] = $this->language->get('text_proxy_score');
			$data['text_is_trans_proxy'] = $this->language->get('text_is_trans_proxy');
			$data['text_free_mail'] = $this->language->get('text_free_mail');
			$data['text_carder_email'] = $this->language->get('text_carder_email');
			$data['text_high_risk_username'] = $this->language->get('text_high_risk_username');
			$data['text_high_risk_password'] = $this->language->get('text_high_risk_password');
			$data['text_bin_match'] = $this->language->get('text_bin_match');
			$data['text_bin_country'] = $this->language->get('text_bin_country');
			$data['text_bin_name_match'] = $this->language->get('text_bin_name_match');
			$data['text_bin_name'] = $this->language->get('text_bin_name');
			$data['text_bin_phone_match'] = $this->language->get('text_bin_phone_match');
			$data['text_bin_phone'] = $this->language->get('text_bin_phone');
			$data['text_customer_phone_in_billing_location'] = $this->language->get('text_customer_phone_in_billing_location');
			$data['text_ship_forward'] = $this->language->get('text_ship_forward');
			$data['text_city_postal_match'] = $this->language->get('text_city_postal_match');
			$data['text_ship_city_postal_match'] = $this->language->get('text_ship_city_postal_match');
			$data['text_score'] = $this->language->get('text_score');
			$data['text_explanation'] = $this->language->get('text_explanation');
			$data['text_risk_score'] = $this->language->get('text_risk_score');
			$data['text_queries_remaining'] = $this->language->get('text_queries_remaining');
			$data['text_maxmind_id'] = $this->language->get('text_maxmind_id');
			$data['text_error'] = $this->language->get('text_error');
			$data['text_loading'] = $this->language->get('text_loading');

			$data['help_country_match'] = $this->language->get('help_country_match');
			$data['help_country_code'] = $this->language->get('help_country_code');
			$data['help_high_risk_country'] = $this->language->get('help_high_risk_country');
			$data['help_distance'] = $this->language->get('help_distance');
			$data['help_ip_region'] = $this->language->get('help_ip_region');
			$data['help_ip_city'] = $this->language->get('help_ip_city');
			$data['help_ip_latitude'] = $this->language->get('help_ip_latitude');
			$data['help_ip_longitude'] = $this->language->get('help_ip_longitude');
			$data['help_ip_isp'] = $this->language->get('help_ip_isp');
			$data['help_ip_org'] = $this->language->get('help_ip_org');
			$data['help_ip_asnum'] = $this->language->get('help_ip_asnum');
			$data['help_ip_user_type'] = $this->language->get('help_ip_user_type');
			$data['help_ip_country_confidence'] = $this->language->get('help_ip_country_confidence');
			$data['help_ip_region_confidence'] = $this->language->get('help_ip_region_confidence');
			$data['help_ip_city_confidence'] = $this->language->get('help_ip_city_confidence');
			$data['help_ip_postal_confidence'] = $this->language->get('help_ip_postal_confidence');
			$data['help_ip_postal_code'] = $this->language->get('help_ip_postal_code');
			$data['help_ip_accuracy_radius'] = $this->language->get('help_ip_accuracy_radius');
			$data['help_ip_net_speed_cell'] = $this->language->get('help_ip_net_speed_cell');
			$data['help_ip_metro_code'] = $this->language->get('help_ip_metro_code');
			$data['help_ip_area_code'] = $this->language->get('help_ip_area_code');
			$data['help_ip_time_zone'] = $this->language->get('help_ip_time_zone');
			$data['help_ip_region_name'] = $this->language->get('help_ip_region_name');
			$data['help_ip_domain'] = $this->language->get('help_ip_domain');
			$data['help_ip_country_name'] = $this->language->get('help_ip_country_name');
			$data['help_ip_continent_code'] = $this->language->get('help_ip_continent_code');
			$data['help_ip_corporate_proxy'] = $this->language->get('help_ip_corporate_proxy');
			$data['help_anonymous_proxy'] = $this->language->get('help_anonymous_proxy');
			$data['help_proxy_score'] = $this->language->get('help_proxy_score');
			$data['help_is_trans_proxy'] = $this->language->get('help_is_trans_proxy');
			$data['help_free_mail'] = $this->language->get('help_free_mail');
			$data['help_carder_email'] = $this->language->get('help_carder_email');
			$data['help_high_risk_username'] = $this->language->get('help_high_risk_username');
			$data['help_high_risk_password'] = $this->language->get('help_high_risk_password');
			$data['help_bin_match'] = $this->language->get('help_bin_match');
			$data['help_bin_country'] = $this->language->get('help_bin_country');
			$data['help_bin_name_match'] = $this->language->get('help_bin_name_match');
			$data['help_bin_name'] = $this->language->get('help_bin_name');
			$data['help_bin_phone_match'] = $this->language->get('help_bin_phone_match');
			$data['help_bin_phone'] = $this->language->get('help_bin_phone');
			$data['help_customer_phone_in_billing_location'] = $this->language->get('help_customer_phone_in_billing_location');
			$data['help_ship_forward'] = $this->language->get('help_ship_forward');
			$data['help_city_postal_match'] = $this->language->get('help_city_postal_match');
			$data['help_ship_city_postal_match'] = $this->language->get('help_ship_city_postal_match');
			$data['help_score'] = $this->language->get('help_score');
			$data['help_explanation'] = $this->language->get('help_explanation');
			$data['help_risk_score'] = $this->language->get('help_risk_score');
			$data['help_queries_remaining'] = $this->language->get('help_queries_remaining');
			$data['help_maxmind_id'] = $this->language->get('help_maxmind_id');
			$data['help_error'] = $this->language->get('help_error');

			$data['column_product'] = $this->language->get('column_product');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');

			$data['entry_order_status'] = $this->language->get('entry_order_status');
			$data['entry_notify'] = $this->language->get('entry_notify');
			$data['entry_comment'] = $this->language->get('entry_comment');

			$data['button_invoice_print'] = $this->language->get('button_invoice_print');
			$data['button_shipping_print'] = $this->language->get('button_shipping_print');
			$data['button_edit'] = $this->language->get('button_edit');
			$data['button_cancel'] = $this->language->get('button_cancel');
			$data['button_generate'] = $this->language->get('button_generate');
			$data['button_reward_add'] = $this->language->get('button_reward_add');
			$data['button_reward_remove'] = $this->language->get('button_reward_remove');
			$data['button_commission_add'] = $this->language->get('button_commission_add');
			$data['button_commission_remove'] = $this->language->get('button_commission_remove');
			$data['button_history_add'] = $this->language->get('button_history_add');

			$data['tab_order'] = $this->language->get('tab_order');
			$data['tab_payment'] = $this->language->get('tab_payment');
			$data['tab_shipping'] = $this->language->get('tab_shipping');
			$data['tab_product'] = $this->language->get('tab_product');
			$data['tab_history'] = $this->language->get('tab_history');
			$data['tab_fraud'] = $this->language->get('tab_fraud');
			$data['tab_action'] = $this->language->get('tab_action');
			
			$data['mvd_sales_order_invoice_address'] = $this->config->get('mvd_sales_order_invoice_address');
			$data['mvd_sales_order_detail'] = $this->config->get('mvd_sales_order_detail');
			$data['mvd_sales_payment_detail'] = $this->config->get('mvd_sales_payment_detail');
			$data['mvd_sales_shipping_detail'] = $this->config->get('sales_order_detail');
			$data['mvd_sales_product'] = $this->config->get('mvd_sales_product');
			$data['mvd_sales_order_history'] = $this->config->get('mvd_sales_order_history');
			$data['mvd_sales_order_history_update'] = $this->config->get('mvd_sales_order_history_update');
			$data['mvd_sales_order_allow_notification'] = $this->config->get('mvd_sales_order_allow_notification');
			$data['mvd_sales_order_status_availability'] = $this->config->get('mvd_sales_order_status_availability');

			$data['token'] = $this->session->data['token'];

			$url = '';

			if (isset($this->request->get['filter_order_id'])) {
				$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
			}

			if (isset($this->request->get['filter_customer'])) {
				$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_order_status'])) {
				$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
			}

			if (isset($this->request->get['filter_total'])) {
				$url .= '&filter_total=' . $this->request->get['filter_total'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

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
				'href' => $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . $url, 'SSL')
			);

			$data['shipping'] = $this->url->link('sale/vdi_order/shipping', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
			$data['invoice'] = $this->url->link('sale/vdi_order/invoice', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
			$data['edit'] = $this->url->link('sale/vdi_order/edit', 'token=' . $this->session->data['token'] . '&order_id=' . (int)$this->request->get['order_id'], 'SSL');
			$data['cancel'] = $this->url->link('sale/vdi_order', 'token=' . $this->session->data['token'] . $url, 'SSL');

			$data['order_id'] = $this->request->get['order_id'];
			$data['vendor_id'] = $this->user->getVP();
			
			if ($order_info['invoice_no']) {
				$data['invoice_no'] = $order_info['invoice_prefix'] . $order_info['invoice_no'];
			} else {
				$data['invoice_no'] = '';
			}

			$data['store_name'] = $order_info['store_name'];
			$data['store_url'] = $order_info['store_url'];
			$data['firstname'] = $order_info['firstname'];
			$data['lastname'] = $order_info['lastname'];

			if ($order_info['customer_id']) {
				$data['customer'] = $this->url->link('sale/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $order_info['customer_id'], 'SSL');
			} else {
				$data['customer'] = '';
			}

			$this->load->model('sale/customer_group');

			$customer_group_info = $this->model_sale_customer_group->getCustomerGroup($order_info['customer_group_id']);

			if ($customer_group_info) {
				$data['customer_group'] = $customer_group_info['name'];
			} else {
				$data['customer_group'] = '';
			}

			$data['email'] = $order_info['email'];
			$data['telephone'] = $order_info['telephone'];
			$data['fax'] = $order_info['fax'];
			$data['account_custom_field'] = $order_info['custom_field'];
		
		
			// Custom Fields
			$this->load->model('sale/custom_field');
			
			$data['account_custom_fields'] = array();

			$custom_fields = $this->model_sale_custom_field->getCustomFields();

			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'account' && isset($order_info['custom_field'][$custom_field['custom_field_id']])) {
					if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
						$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['custom_field'][$custom_field['custom_field_id']]);
						
						if ($custom_field_value_info) {
							$data['account_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $custom_field_value_info['name']
							);
						}
					}
					
					if ($custom_field['type'] == 'checkbox' && is_array($order_info['custom_field'][$custom_field['custom_field_id']])) {
						foreach ($order_info['custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
							$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);
							
							if ($custom_field_value_info) {						
								$data['account_custom_fields'][] = array(
									'name'  => $custom_field['name'],
									'value' => $custom_field_value_info['name']
								);	
							}
						}
					}
										
					if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
						$data['account_custom_fields'][] = array(
							'name'  => $custom_field['name'],
							'value' => $order_info['custom_field'][$custom_field['custom_field_id']]
						);						
					}
					
					if ($custom_field['type'] == 'file') {
						$upload_info = $this->model_tool_upload->getUploadByCode($order_info['custom_field'][$custom_field['custom_field_id']]);

						if ($upload_info) {
							$data['account_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $upload_info['name']
							);							
						}
					}
				}
			}
			
			$data['comment'] = nl2br($order_info['comment']);
			//$data['shipping_method'] = '';
			$data['shipping_method'] = $order_info['shipping_method'];
			$data['payment_method'] = $order_info['payment_method'];
			$data['total'] = $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value']);

			$this->load->model('sale/customer');

			$data['reward'] = $order_info['reward'];

			$data['reward_total'] = $this->model_sale_customer->getTotalCustomerRewardsByOrderId($this->request->get['order_id']);

			$data['affiliate_firstname'] = $order_info['affiliate_firstname'];
			$data['affiliate_lastname'] = $order_info['affiliate_lastname'];

			if ($order_info['affiliate_id']) {
				$data['affiliate'] = $this->url->link('marketing/affiliate/edit', 'token=' . $this->session->data['token'] . '&affiliate_id=' . $order_info['affiliate_id'], 'SSL');
			} else {
				$data['affiliate'] = '';
			}

			$data['commission'] = $this->currency->format($order_info['commission'], $order_info['currency_code'], $order_info['currency_value']);

			$this->load->model('marketing/affiliate');

			$data['commission_total'] = $this->model_marketing_affiliate->getTotalTransactionsByOrderId($this->request->get['order_id']);

			$this->load->model('localisation/order_status');
			
			$vos_id = $this->model_sale_vdi_order->getVendorOrderStatus($order_id);
			
			if ($vos_id) {
				$vendor_order_status_id = $vos_id;
			} else {
				$vendor_order_status_id = $order_info['order_status_id'];
			}

			$order_status_info = $this->model_localisation_order_status->getOrderStatus($vendor_order_status_id);

			if ($order_status_info) {
				$data['order_status'] = $order_status_info['name'];
			} else {
				$data['order_status'] = '';
			}

			$data['ip'] = $order_info['ip'];
			$data['forwarded_ip'] = $order_info['forwarded_ip'];
			$data['user_agent'] = $order_info['user_agent'];
			$data['accept_language'] = $order_info['accept_language'];
			$data['date_added'] = date($this->language->get('date_format_short'), strtotime($order_info['date_added']));
			$data['date_modified'] = date($this->language->get('date_format_short'), strtotime($order_info['date_modified']));
			$data['payment_firstname'] = $order_info['payment_firstname'];
			$data['payment_lastname'] = $order_info['payment_lastname'];
			$data['payment_company'] = $order_info['payment_company'];
			$data['payment_address_1'] = $order_info['payment_address_1'];
			$data['payment_address_2'] = $order_info['payment_address_2'];
			$data['payment_city'] = $order_info['payment_city'];
			$data['payment_postcode'] = $order_info['payment_postcode'];
			$data['payment_zone'] = $order_info['payment_zone'];
			$data['payment_zone_code'] = $order_info['payment_zone_code'];
			$data['payment_country'] = $order_info['payment_country'];
			
			// Uploaded files			
			$this->load->model('tool/upload');

			// Custom fields
			$data['payment_custom_fields'] = array();

			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'address' && isset($order_info['payment_custom_field'][$custom_field['custom_field_id']])) {
					if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
						$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['payment_custom_field'][$custom_field['custom_field_id']]);
						
						if ($custom_field_value_info) {
							$data['payment_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $custom_field_value_info['name']
							);
						}
					}
					
					if ($custom_field['type'] == 'checkbox' && is_array($order_info['payment_custom_field'][$custom_field['custom_field_id']])) {
						foreach ($order_info['payment_custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
							$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);
							
							if ($custom_field_value_info) {						
								$data['payment_custom_fields'][] = array(
									'name'  => $custom_field['name'],
									'value' => $custom_field_value_info['name']
								);	
							}
						}
					}
										
					if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
						$data['payment_custom_fields'][] = array(
							'name'  => $custom_field['name'],
							'value' => $order_info['payment_custom_field'][$custom_field['custom_field_id']]
						);						
					}
					
					if ($custom_field['type'] == 'file') {
						$upload_info = $this->model_tool_upload->getUploadByCode($order_info['payment_custom_field'][$custom_field['custom_field_id']]);

						if ($upload_info) {
							$data['payment_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $upload_info['name']
							);							
						}
					}
				}
			}
			
			$data['shipping_firstname'] = $order_info['shipping_firstname'];
			$data['shipping_lastname'] = $order_info['shipping_lastname'];
			$data['shipping_company'] = $order_info['shipping_company'];
			$data['shipping_address_1'] = $order_info['shipping_address_1'];
			$data['shipping_address_2'] = $order_info['shipping_address_2'];
			$data['shipping_city'] = $order_info['shipping_city'];
			$data['shipping_postcode'] = $order_info['shipping_postcode'];
			$data['shipping_zone'] = $order_info['shipping_zone'];
			$data['shipping_zone_code'] = $order_info['shipping_zone_code'];
			$data['shipping_country'] = $order_info['shipping_country'];
			
			$data['shipping_custom_fields'] = array();
			
			foreach ($custom_fields as $custom_field) {
				if ($custom_field['location'] == 'address' && isset($order_info['shipping_custom_field'][$custom_field['custom_field_id']])) {
					if ($custom_field['type'] == 'select' || $custom_field['type'] == 'radio') {
						$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($order_info['shipping_custom_field'][$custom_field['custom_field_id']]);
						
						if ($custom_field_value_info) {
							$data['shipping_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $custom_field_value_info['name']
							);
						}
					}
					
					if ($custom_field['type'] == 'checkbox' && is_array($order_info['shipping_custom_field'][$custom_field['custom_field_id']])) {
						foreach ($order_info['shipping_custom_field'][$custom_field['custom_field_id']] as $custom_field_value_id) {
							$custom_field_value_info = $this->model_sale_custom_field->getCustomFieldValue($custom_field_value_id);
							
							if ($custom_field_value_info) {						
								$data['shipping_custom_fields'][] = array(
									'name'  => $custom_field['name'],
									'value' => $custom_field_value_info['name']
								);	
							}
						}
					}
										
					if ($custom_field['type'] == 'text' || $custom_field['type'] == 'textarea' || $custom_field['type'] == 'file' || $custom_field['type'] == 'date' || $custom_field['type'] == 'datetime' || $custom_field['type'] == 'time') {
						$data['shipping_custom_fields'][] = array(
							'name'  => $custom_field['name'],
							'value' => $order_info['shipping_custom_field'][$custom_field['custom_field_id']]
						);						
					}
					
					if ($custom_field['type'] == 'file') {
						$upload_info = $this->model_tool_upload->getUploadByCode($order_info['shipping_custom_field'][$custom_field['custom_field_id']]);

						if ($upload_info) {
							$data['shipping_custom_fields'][] = array(
								'name'  => $custom_field['name'],
								'value' => $upload_info['name']
							);							
						}
					}
				}
			}

			$this->load->model('tool/upload');

			$data['products'] = array();

			$products = $this->model_sale_vdi_order->getOrderProducts($this->request->get['order_id']);

			foreach ($products as $product) {
				$option_data = array();

				$options = $this->model_sale_vdi_order->getOrderOptions($this->request->get['order_id'], $product['order_product_id']);

				foreach ($options as $option) {
					if ($option['type'] != 'file') {
						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $option['value'],
							'type'  => $option['type']
						);
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

						if ($upload_info) {
							$option_data[] = array(
								'name'  => $option['name'],
								'value' => $upload_info['name'],
								'type'  => $option['type'],
								'href'  => $this->url->link('tool/upload/download', 'token=' . $this->session->data['token'] . '&code=' . $upload_info['code'], 'SSL')
							);
						}
					}
				}

				$data['products'][] = array(
					'order_product_id' => $product['order_product_id'],
					'product_id'       => $product['product_id'],
					'name'    	 	   => $product['name'],
					'model'    		   => $product['model'],
					'option'   		   => $option_data,
					'quantity'		   => $product['quantity'],
					'price'    		   => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
					'total'    		   => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value']),
					'href'     		   => $this->url->link('catalog/vdi_product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], 'SSL')
				);
			}

			$data['vouchers'] = array();

			$vouchers = $this->model_sale_vdi_order->getOrderVouchers($this->request->get['order_id']);

			foreach ($vouchers as $voucher) {
				$data['vouchers'][] = array(
					'description' => $voucher['description'],
					'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value']),
					'href'        => $this->url->link('sale/voucher/edit', 'token=' . $this->session->data['token'] . '&voucher_id=' . $voucher['voucher_id'], 'SSL')
				);
			}

			$getOrderTotals = $this->model_sale_vdi_order->getOrderTotals($this->request->get['order_id']);
			
			foreach ($getOrderTotals as $order_totals) {
				$data['subtotal'] = $this->currency->format($order_totals['total'], $order_info['currency_code'], $order_info['currency_value']);
				$data['totals'] = $this->currency->format($order_totals['total'] + $order_totals['shipping_cost'] - $order_totals['coupon_amount'] + ($this->config->get('tax_status') ? ($order_totals['shipping_tax'] + $order_totals['tax'] - $order_totals['coupon_tax']): 0), $order_info['currency_code'], $order_info['currency_value']);
				
				if (($order_totals['shipping_cost'] > 0) && isset($order_totals['shipping_cost'])) {
					$data['shipping_weight'] = $order_totals['title'] . ' (' . $this->language->get('text_weight') . ': ' . $this->weight->format($order_totals['shipping_weight'], $this->config->get('config_weight_class_id')) . ') ';
					$data['shipping_cost'] = $this->currency->format($order_totals['shipping_cost'], $order_info['currency_code'], $order_info['currency_value']);
				} else {
					$data['shipping_weight'] = False;
					$data['shipping_cost'] = false;
				}
				
				if ($order_totals['coupon_amount'] > 0) {
					$data['coupon_title'] = $order_totals['coupon_title'];
					$data['coupon_amount'] = $this->currency->format($order_totals['coupon_amount'], $order_info['currency_code'], $order_info['currency_value']);
				} else {
					$data['coupon_amount'] = False;
				}
				
				if ($this->config->get('tax_status')) {
					$data['tax_title'] = $order_totals['tax_title'];
					$data['tax'] = $this->currency->format($order_totals['shipping_tax'] + $order_totals['tax'] - $order_totals['coupon_tax'], $order_info['currency_code'], $order_info['currency_value']);
				} else {
					$data['tax'] = False;
				}
			}

			$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

			$data['order_status_id'] = $order_info['order_status_id'];

			// Unset any past sessions this page date_added for the api to work.
			unset($this->session->data['cookie']);

			// Set up the API session
			if ($this->user->hasPermission('modify', 'sale/vdi_order')) {
				$this->load->model('user/api');

				$api_info = $this->model_user_api->getApi($this->config->get('config_api_id'));

				if ($api_info) {
					$curl = curl_init();

					// Set SSL if required
					if (substr(HTTPS_CATALOG, 0, 5) == 'https') {
						curl_setopt($curl, CURLOPT_PORT, 443);
					}

					curl_setopt($curl, CURLOPT_HEADER, false);
					curl_setopt($curl, CURLINFO_HEADER_OUT, true);
					curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($curl, CURLOPT_URL, HTTPS_CATALOG . 'index.php?route=api/login');
					curl_setopt($curl, CURLOPT_POST, true);
					curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($api_info));

					$json = curl_exec($curl);

					if (!$json) {
						$data['error_warning'] = sprintf($this->language->get('error_curl'), curl_error($curl), curl_errno($curl));
					} else {
						$response = json_decode($json, true);
					}

					if (isset($response['cookie'])) {
						$this->session->data['cookie'] = $response['cookie'];
					}
				}
			}

			if (isset($response['cookie'])) {
				$this->session->data['cookie'] = $response['cookie'];
			} else {
				$data['error_warning'] = $this->language->get('error_permission');
			}

			// Fraud
			$this->load->model('sale/fraud');

			$fraud_info = $this->model_sale_fraud->getFraud($order_info['order_id']);

			if ($fraud_info) {
				$data['country_match'] = $fraud_info['country_match'];

				if ($fraud_info['country_code']) {
					$data['country_code'] = $fraud_info['country_code'];
				} else {
					$data['country_code'] = '';
				}

				$data['high_risk_country'] = $fraud_info['high_risk_country'];
				$data['distance'] = $fraud_info['distance'];

				if ($fraud_info['ip_region']) {
					$data['ip_region'] = $fraud_info['ip_region'];
				} else {
					$data['ip_region'] = '';
				}

				if ($fraud_info['ip_city']) {
					$data['ip_city'] = $fraud_info['ip_city'];
				} else {
					$data['ip_city'] = '';
				}

				$data['ip_latitude'] = $fraud_info['ip_latitude'];
				$data['ip_longitude'] = $fraud_info['ip_longitude'];

				if ($fraud_info['ip_isp']) {
					$data['ip_isp'] = $fraud_info['ip_isp'];
				} else {
					$data['ip_isp'] = '';
				}

				if ($fraud_info['ip_org']) {
					$data['ip_org'] = $fraud_info['ip_org'];
				} else {
					$data['ip_org'] = '';
				}

				$data['ip_asnum'] = $fraud_info['ip_asnum'];

				if ($fraud_info['ip_user_type']) {
					$data['ip_user_type'] = $fraud_info['ip_user_type'];
				} else {
					$data['ip_user_type'] = '';
				}

				if ($fraud_info['ip_country_confidence']) {
					$data['ip_country_confidence'] = $fraud_info['ip_country_confidence'];
				} else {
					$data['ip_country_confidence'] = '';
				}

				if ($fraud_info['ip_region_confidence']) {
					$data['ip_region_confidence'] = $fraud_info['ip_region_confidence'];
				} else {
					$data['ip_region_confidence'] = '';
				}

				if ($fraud_info['ip_city_confidence']) {
					$data['ip_city_confidence'] = $fraud_info['ip_city_confidence'];
				} else {
					$data['ip_city_confidence'] = '';
				}

				if ($fraud_info['ip_postal_confidence']) {
					$data['ip_postal_confidence'] = $fraud_info['ip_postal_confidence'];
				} else {
					$data['ip_postal_confidence'] = '';
				}

				if ($fraud_info['ip_postal_code']) {
					$data['ip_postal_code'] = $fraud_info['ip_postal_code'];
				} else {
					$data['ip_postal_code'] = '';
				}

				$data['ip_accuracy_radius'] = $fraud_info['ip_accuracy_radius'];

				if ($fraud_info['ip_net_speed_cell']) {
					$data['ip_net_speed_cell'] = $fraud_info['ip_net_speed_cell'];
				} else {
					$data['ip_net_speed_cell'] = '';
				}

				$data['ip_metro_code'] = $fraud_info['ip_metro_code'];
				$data['ip_area_code'] = $fraud_info['ip_area_code'];

				if ($fraud_info['ip_time_zone']) {
					$data['ip_time_zone'] = $fraud_info['ip_time_zone'];
				} else {
					$data['ip_time_zone'] = '';
				}

				if ($fraud_info['ip_region_name']) {
					$data['ip_region_name'] = $fraud_info['ip_region_name'];
				} else {
					$data['ip_region_name'] = '';
				}

				if ($fraud_info['ip_domain']) {
					$data['ip_domain'] = $fraud_info['ip_domain'];
				} else {
					$data['ip_domain'] = '';
				}

				if ($fraud_info['ip_country_name']) {
					$data['ip_country_name'] = $fraud_info['ip_country_name'];
				} else {
					$data['ip_country_name'] = '';
				}

				if ($fraud_info['ip_continent_code']) {
					$data['ip_continent_code'] = $fraud_info['ip_continent_code'];
				} else {
					$data['ip_continent_code'] = '';
				}

				if ($fraud_info['ip_corporate_proxy']) {
					$data['ip_corporate_proxy'] = $fraud_info['ip_corporate_proxy'];
				} else {
					$data['ip_corporate_proxy'] = '';
				}

				$data['anonymous_proxy'] = $fraud_info['anonymous_proxy'];
				$data['proxy_score'] = $fraud_info['proxy_score'];

				if ($fraud_info['is_trans_proxy']) {
					$data['is_trans_proxy'] = $fraud_info['is_trans_proxy'];
				} else {
					$data['is_trans_proxy'] = '';
				}

				$data['free_mail'] = $fraud_info['free_mail'];
				$data['carder_email'] = $fraud_info['carder_email'];

				if ($fraud_info['high_risk_username']) {
					$data['high_risk_username'] = $fraud_info['high_risk_username'];
				} else {
					$data['high_risk_username'] = '';
				}

				if ($fraud_info['high_risk_password']) {
					$data['high_risk_password'] = $fraud_info['high_risk_password'];
				} else {
					$data['high_risk_password'] = '';
				}

				$data['bin_match'] = $fraud_info['bin_match'];

				if ($fraud_info['bin_country']) {
					$data['bin_country'] = $fraud_info['bin_country'];
				} else {
					$data['bin_country'] = '';
				}

				$data['bin_name_match'] = $fraud_info['bin_name_match'];

				if ($fraud_info['bin_name']) {
					$data['bin_name'] = $fraud_info['bin_name'];
				} else {
					$data['bin_name'] = '';
				}

				$data['bin_phone_match'] = $fraud_info['bin_phone_match'];

				if ($fraud_info['bin_phone']) {
					$data['bin_phone'] = $fraud_info['bin_phone'];
				} else {
					$data['bin_phone'] = '';
				}

				if ($fraud_info['customer_phone_in_billing_location']) {
					$data['customer_phone_in_billing_location'] = $fraud_info['customer_phone_in_billing_location'];
				} else {
					$data['customer_phone_in_billing_location'] = '';
				}

				$data['ship_forward'] = $fraud_info['ship_forward'];

				if ($fraud_info['city_postal_match']) {
					$data['city_postal_match'] = $fraud_info['city_postal_match'];
				} else {
					$data['city_postal_match'] = '';
				}

				if ($fraud_info['ship_city_postal_match']) {
					$data['ship_city_postal_match'] = $fraud_info['ship_city_postal_match'];
				} else {
					$data['ship_city_postal_match'] = '';
				}

				$data['score'] = $fraud_info['score'];
				$data['explanation'] = $fraud_info['explanation'];
				$data['risk_score'] = $fraud_info['risk_score'];
				$data['queries_remaining'] = $fraud_info['queries_remaining'];
				$data['maxmind_id'] = $fraud_info['maxmind_id'];
				$data['error'] = $fraud_info['error'];
			} else {
				$data['maxmind_id'] = '';
			}

			$data['payment_action'] = $this->load->controller('payment/' . $order_info['payment_code'] . '/orderAction', '');

			$data['header'] = $this->load->controller('common/vdi_header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('sale/vdi_order_info.tpl', $data));
		} else {
			$this->load->language('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_not_found'] = $this->language->get('text_not_found');

			$data['breadcrumbs'] = array();

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/vdi_dashboard', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL')
			);

			$data['header'] = $this->load->controller('common/vdi_header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');

			$this->response->setOutput($this->load->view('error/not_found.tpl', $data));
		}
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function createInvoiceNo() {
		$this->load->language('sale/vdi_order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$json['error'] = $this->language->get('error_permission');
		} elseif (isset($this->request->get['order_id'])) {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$this->load->model('sale/vdi_order');

			$invoice_no = $this->model_sale_vdi_order->createInvoiceNo($order_id);

			if ($invoice_no) {
				$json['invoice_no'] = $invoice_no;
			} else {
				$json['error'] = $this->language->get('error_action');
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function createInvoiceNo2() {
		$this->load->language('sale/vdi_order');

		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$json['error'] = $this->language->get('error_permission');
		} elseif (isset($this->request->get['order_id'])) {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$this->load->model('sale/vdi_order');

			$invoice_no = $this->model_sale_vdi_order->createInvoiceNo($order_id);

			if ($invoice_no) {
				return true;
			} else {
				return false;
			}
		}
	}

	public function addReward() {
		$this->load->language('sale/vdi_order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$this->load->model('sale/vdi_order');

			$order_info = $this->model_sale_vdi_order->getOrder($order_id);

			if ($order_info && $order_info['customer_id'] && ($order_info['reward'] > 0)) {
				$this->load->model('sale/customer');

				$reward_total = $this->model_sale_customer->getTotalCustomerRewardsByOrderId($order_id);

				if (!$reward_total) {
					$this->model_sale_customer->addReward($order_info['customer_id'], $this->language->get('text_order_id') . ' #' . $order_id, $order_info['reward'], $order_id);
				}
			}

			$json['success'] = $this->language->get('text_reward_added');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function removeReward() {
		$this->load->language('sale/vdi_order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$this->load->model('sale/vdi_order');

			$order_info = $this->model_sale_vdi_order->getOrder($order_id);

			if ($order_info) {
				$this->load->model('sale/customer');

				$this->model_sale_customer->deleteReward($order_id);
			}

			$json['success'] = $this->language->get('text_reward_removed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function addCommission() {
		$this->load->language('sale/vdi_order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$this->load->model('sale/vdi_order');

			$order_info = $this->model_sale_vdi_order->getOrder($order_id);

			if ($order_info) {
				$this->load->model('marketing/affiliate');

				$affiliate_total = $this->model_marketing_affiliate->getTotalTransactionsByOrderId($order_id);

				if (!$affiliate_total) {
					$this->model_marketing_affiliate->addTransaction($order_info['affiliate_id'], $this->language->get('text_order_id') . ' #' . $order_id, $order_info['commission'], $order_id);
				}
			}

			$json['success'] = $this->language->get('text_commission_added');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function removeCommission() {
		$this->load->language('sale/vdi_order');

		$json = array();

		if (!$this->user->hasPermission('modify', 'sale/vdi_order')) {
			$json['error'] = $this->language->get('error_permission');
		} else {
			if (isset($this->request->get['order_id'])) {
				$order_id = $this->request->get['order_id'];
			} else {
				$order_id = 0;
			}

			$this->load->model('sale/vdi_order');

			$order_info = $this->model_sale_vdi_order->getOrder($order_id);

			if ($order_info) {
				$this->load->model('marketing/affiliate');

				$this->model_marketing_affiliate->deleteTransaction($order_id);
			}

			$json['success'] = $this->language->get('text_commission_removed');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function history() {
		$this->load->language('sale/vdi_order');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_notify'] = $this->language->get('column_notify');
		$data['column_comment'] = $this->language->get('column_comment');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$this->load->model('sale/vdi_order');
		//echo $this->config->get('order_status')."--";
		if ($this->model_sale_vdi_order->getCurrentMultiVendorOrderStatus($this->request->get['order_id']) != $this->model_sale_vdi_order->getRequiredMultiVendorsOrderStatus($this->request->get['order_id'])) {
			if ($this->model_sale_vdi_order->getThisMaxVendorOrderStatus($this->request->get['order_id']) != $this->model_sale_vdi_order->getThisVendorOrderStatus($this->request->get['order_id'])) {
				$pending_vendor = sprintf($this->language->get('text_pending_vendor'), $this->model_sale_vdi_order->getOrderStatusName((int)$this->config->get('mvd_order_status')));
			} else {
				$pending_vendor = sprintf($this->language->get('text_pending_other_vendor'), $this->model_sale_vdi_order->getOrderStatusName((int)$this->config->get('mvd_order_status')));
			}
		} else {
			$this->model_sale_vdi_order->updateOrderStatus($this->request->get['order_id'],$this->config->get('mvd_order_status'));
			$pending_vendor = '';
		}

		$data['histories'] = array();

		$this->load->model('sale/vdi_order');

		$results = $this->model_sale_vdi_order->getOrderHistories($this->request->get['order_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$data['histories'][] = array(
				'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'status'     => $result['status'] . ($result['vendor_id'] ? '' : ' - ' . $this->language->get('text_default_store')),
				'comment'    => nl2br($result['comment']) . $pending_vendor,
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$history_total = $this->model_sale_vdi_order->getTotalOrderHistories($this->request->get['order_id']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('sale/vdi_order/history', 'token=' . $this->session->data['token'] . '&order_id=' . $this->request->get['order_id'] . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

		$this->response->setOutput($this->load->view('sale/vdi_order_history.tpl', $data));
	}

	public function invoice() {
		$this->load->language('sale/vdi_order');

		$data['title'] = $this->language->get('text_invoice');

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_invoice'] = $this->language->get('text_invoice');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_ship_to'] = $this->language->get('text_ship_to');
		$data['text_payment_method'] = $this->language->get('text_payment_method');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_subtotal'] = $this->language->get('text_subtotal');
		$data['text_total'] = $this->language->get('text_total');

		$data['column_product'] = $this->language->get('column_product');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_total'] = $this->language->get('column_total');
		$data['column_comment'] = $this->language->get('column_comment');

		$this->load->model('sale/vdi_order');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}
		
		$data['mvd_sales_order_invoice_address'] = $this->config->get('mvd_sales_order_invoice_address');
		
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_vdi_order->getOrder($order_id);

			if ($order_info) {
				$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
				$address_data = $this->model_sale_vdi_order->getVendorAddress();
				$data['company'] = $address_data['company'];
				if ($this->config->get('mvd_sales_order_invoice_address')) {
					$format = '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				
					$find = array(
					'{firstname}',
					'{lastname}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
					);

					$replace = array(
						'firstname' => $address_data['firstname'],
						'lastname'  => $address_data['lastname'],
						'address_1' => $address_data['address_1'],
						'address_2' => $address_data['address_2'],
						'city'      => $address_data['city'],
						'postcode'  => $address_data['postcode'],
						'zone'      => $address_data['zone'],
						'zone_code' => $address_data['zone_code'],
						'country'   => $address_data['country']
					);
					
					$vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				
					$store_address = $vendor_address;
					$store_email = $address_data['email'];
					$store_telephone = $address_data['telephone'];
					$store_fax = $address_data['fax'];
				} else {
					if ($store_info) {
						$store_address = $store_info['config_address'];
						$store_email = $store_info['config_email'];
						$store_telephone = $store_info['config_telephone'];
						$store_fax = $store_info['config_fax'];
					} else {
						$store_address = $this->config->get('config_address');
						$store_email = $this->config->get('config_email');
						$store_telephone = $this->config->get('config_telephone');
						$store_fax = $this->config->get('config_fax');
					}
				}

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				if ($order_info['payment_address_format']) {
					$format = $order_info['payment_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['payment_firstname'],
					'lastname'  => $order_info['payment_lastname'],
					'company'   => $order_info['payment_company'],
					'address_1' => $order_info['payment_address_1'],
					'address_2' => $order_info['payment_address_2'],
					'city'      => $order_info['payment_city'],
					'postcode'  => $order_info['payment_postcode'],
					'zone'      => $order_info['payment_zone'],
					'zone_code' => $order_info['payment_zone_code'],
					'country'   => $order_info['payment_country']
				);

				$payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				if ($order_info['shipping_address_format']) {
					$format = $order_info['shipping_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['shipping_firstname'],
					'lastname'  => $order_info['shipping_lastname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$this->load->model('tool/upload');

				$product_data = array();

				$products = $this->model_sale_vdi_order->getOrderProducts($order_id);

				foreach ($products as $product) {
					$option_data = array();

					$options = $this->model_sale_vdi_order->getOrderOptions($order_id, $product['order_product_id']);

					foreach ($options as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							if ($upload_info) {
								$value = $upload_info['name'];
							} else {
								$value = '';
							}
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $value
						);
					}

					$product_data[] = array(
						'name'     => $product['name'],
						'model'    => $product['model'],
						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $order_info['currency_code'], $order_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $order_info['currency_code'], $order_info['currency_value'])
					);
				}

				$voucher_data = array();

				$vouchers = $this->model_sale_vdi_order->getOrderVouchers($order_id);

				foreach ($vouchers as $voucher) {
					$voucher_data[] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $order_info['currency_code'], $order_info['currency_value'])
					);
				}
				
				$getOrderTotals = $this->model_sale_vdi_order->getOrderTotals($order_id);
			
				foreach ($getOrderTotals as $order_totals) {
					$data['subtotal'] = $this->currency->format($order_totals['total'], $order_info['currency_code'], $order_info['currency_value']);
					$data['totals'] = $this->currency->format($order_totals['total'] + $order_totals['shipping_cost'] - $order_totals['coupon_amount'] + ($this->config->get('tax_status') ? ($order_totals['shipping_tax'] + $order_totals['tax'] - $order_totals['coupon_tax']): 0), $order_info['currency_code'], $order_info['currency_value']);
					
					if (($order_totals['shipping_cost'] > 0) && isset($order_totals['shipping_cost'])) {
						$data['shipping_weight'] = $order_totals['title'] . ' (' . $this->language->get('text_weight') . ': ' . $this->weight->format($order_totals['shipping_weight'], $this->config->get('config_weight_class_id')) . ') ';
						$data['shipping_cost'] = $this->currency->format($order_totals['shipping_cost'], $order_info['currency_code'], $order_info['currency_value']);
					} else {
						$data['shipping_weight'] = False;
						$data['shipping_cost'] = false;
					}
					
					if ($order_totals['coupon_amount'] > 0) {
						$data['coupon_title'] = $order_totals['coupon_title'];
						$data['coupon_amount'] = $this->currency->format($order_totals['coupon_amount'], $order_info['currency_code'], $order_info['currency_value']);
					} else {
						$data['coupon_amount'] = False;
					}
					
					if ($this->config->get('tax_status')) {
						$data['tax_title'] = $order_totals['tax_title'];
						$data['tax'] = $this->currency->format($order_totals['shipping_tax'] + $order_totals['tax'] - $order_totals['coupon_tax'], $order_info['currency_code'], $order_info['currency_value']);
					} else {
						$data['tax'] = False;
					}
				}

				$data['orders'][] = array(
					'order_id'	         => $order_id,
					'invoice_no'         => $invoice_no,
					'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'         => $order_info['store_name'],
					'store_url'          => rtrim($order_info['store_url'], '/'),
					'store_address'      => nl2br($store_address),
					'store_email'        => $store_email,
					'store_telephone'    => $store_telephone,
					'store_fax'          => $store_fax,
					'email'              => $order_info['email'],
					'telephone'          => $order_info['telephone'],
					'shipping_address'   => $shipping_address,
					'shipping_method'    => $order_info['shipping_method'],
					'payment_address'    => $payment_address,
					'payment_method'     => $order_info['payment_method'],
					'product'            => $product_data,
					'voucher'            => $voucher_data,
					'comment'            => nl2br($order_info['comment'])
				);
			}
		}

		$this->response->setOutput($this->load->view('sale/vdi_order_invoice.tpl', $data));
	}
	
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_email'])) {
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_email'])) {
				$filter_email = $this->request->get['filter_email'];
			} else {
				$filter_email = '';
			}

			$this->load->model('sale/vdi_order');

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_email' => $filter_email,
				'start'        => 0,
				'limit'        => 5
			);
			
			$results = $this->model_sale_vdi_order->getCustomers($filter_data);

			foreach ($results as $result) {
					$json[] = array(
						'customer_id'       => $result['customer_id'],
						'customer_group_id' => $result['customer_group_id'],
						'name'              => $result['name'],
						'customer_group'    => $result['customer_group'],
						'firstname'         => $result['firstname'],
						'lastname'          => $result['lastname'],
						'email'             => $result['email'],
						'telephone'         => $result['telephone'],
						'fax'               => $result['fax'],
						'custom_field'      => $result['custom_field'],
						'address'           => $result['address']
					);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function shipping() {
		$this->load->language('sale/vdi_order');

		$data['title'] = $this->language->get('text_shipping');

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['direction'] = $this->language->get('direction');
		$data['lang'] = $this->language->get('code');

		$data['text_shipping'] = $this->language->get('text_shipping');
		$data['text_picklist'] = $this->language->get('text_picklist');
		$data['text_order_detail'] = $this->language->get('text_order_detail');
		$data['text_order_id'] = $this->language->get('text_order_id');
		$data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$data['text_date_added'] = $this->language->get('text_date_added');
		$data['text_telephone'] = $this->language->get('text_telephone');
		$data['text_fax'] = $this->language->get('text_fax');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_website'] = $this->language->get('text_website');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_from'] = $this->language->get('text_from');
		$data['text_to'] = $this->language->get('text_to');
		$data['text_shipping_method'] = $this->language->get('text_shipping_method');
		$data['text_sku'] = $this->language->get('text_sku');
		$data['text_upc'] = $this->language->get('text_upc');
		$data['text_ean'] = $this->language->get('text_ean');
		$data['text_jan'] = $this->language->get('text_jan');
		$data['text_isbn'] = $this->language->get('text_isbn');
		$data['text_mpn'] = $this->language->get('text_mpn');

		$data['column_location'] = $this->language->get('column_location');
		$data['column_reference'] = $this->language->get('column_reference');
		$data['column_product'] = $this->language->get('column_product');
		$data['column_weight'] = $this->language->get('column_weight');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_comment'] = $this->language->get('column_comment');

		$this->load->model('sale/vdi_order');

		$this->load->model('catalog/product');

		$this->load->model('setting/setting');

		$data['orders'] = array();

		$orders = array();

		if (isset($this->request->post['selected'])) {
			$orders = $this->request->post['selected'];
		} elseif (isset($this->request->get['order_id'])) {
			$orders[] = $this->request->get['order_id'];
		}
		
		$data['mvd_sales_order_invoice_address'] = $this->config->get('mvd_sales_order_invoice_address');
		$address_data = $this->model_sale_vdi_order->getVendorAddress();
		$data['company'] = $address_data['company'];
		
		foreach ($orders as $order_id) {
			$order_info = $this->model_sale_vdi_order->getOrder($order_id);

			// Make sure there is a shipping method
			if ($order_info && $order_info['shipping_code']) {
				$store_info = $this->model_setting_setting->getSetting('config', $order_info['store_id']);
				
				if ($this->config->get('mvd_sales_order_invoice_address')) {
					$format = '{firstname} {lastname}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';				
					$find = array(
					'{firstname}',
					'{lastname}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
					);

					$replace = array(
						'firstname' => $address_data['firstname'],
						'lastname'  => $address_data['lastname'],
						'address_1' => $address_data['address_1'],
						'address_2' => $address_data['address_2'],
						'city'      => $address_data['city'],
						'postcode'  => $address_data['postcode'],
						'zone'      => $address_data['zone'],
						'zone_code' => $address_data['zone_code'],
						'country'   => $address_data['country']
					);
					
					$vendor_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));
				
					$store_address = $vendor_address;
					$store_email = $address_data['email'];
					$store_telephone = $address_data['telephone'];
					$store_fax = $address_data['fax'];
				} else {
					if ($store_info) {
						$store_address = $store_info['config_address'];
						$store_email = $store_info['config_email'];
						$store_telephone = $store_info['config_telephone'];
						$store_fax = $store_info['config_fax'];
					} else {
						$store_address = $this->config->get('config_address');
						$store_email = $this->config->get('config_email');
						$store_telephone = $this->config->get('config_telephone');
						$store_fax = $this->config->get('config_fax');
					}
				}

				if ($order_info['invoice_no']) {
					$invoice_no = $order_info['invoice_prefix'] . $order_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				if ($order_info['shipping_address_format']) {
					$format = $order_info['shipping_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $order_info['shipping_firstname'],
					'lastname'  => $order_info['shipping_lastname'],
					'company'   => $order_info['shipping_company'],
					'address_1' => $order_info['shipping_address_1'],
					'address_2' => $order_info['shipping_address_2'],
					'city'      => $order_info['shipping_city'],
					'postcode'  => $order_info['shipping_postcode'],
					'zone'      => $order_info['shipping_zone'],
					'zone_code' => $order_info['shipping_zone_code'],
					'country'   => $order_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$this->load->model('tool/upload');

				$product_data = array();

				$products = $this->model_sale_vdi_order->getOrderProducts($order_id);

				foreach ($products as $product) {
					$product_info = $this->model_catalog_product->getProduct($product['product_id']);

					$option_data = array();

					$options = $this->model_sale_vdi_order->getOrderOptions($order_id, $product['order_product_id']);

					foreach ($options as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

							if ($upload_info) {
								$value = $upload_info['name'];
							} else {
								$value = '';
							}
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $value
						);
					}

					$product_data[] = array(
						'name'     => $product_info['name'],
						'model'    => $product_info['model'],
						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'location' => $product_info['location'],
						'sku'      => $product_info['sku'],
						'upc'      => $product_info['upc'],
						'ean'      => $product_info['ean'],
						'jan'      => $product_info['jan'],
						'isbn'     => $product_info['isbn'],
						'mpn'      => $product_info['mpn'],
						'weight'   => $this->weight->format($product_info['weight'], $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'))
					);
				}
				
				$getOrderTotals = $this->model_sale_vdi_order->getOrderTotals($order_id);
			
				foreach ($getOrderTotals as $order_totals) {
					if ($order_totals['shipping_cost'] > 0) {
						$data['shipping_weight'] = $order_totals['title'] . ' (' . $this->language->get('text_weight') . ': ' . $this->weight->format($order_totals['shipping_weight'], $this->config->get('config_weight_class_id')) . ') ';
						$data['shipping_cost'] = $this->currency->format($order_totals['shipping_cost'], $order_info['currency_code'], $order_info['currency_value']);
					} else {
						$data['shipping_weight'] = False;
						$data['shipping_cost'] = False;
					}
				}

				$data['orders'][] = array(
					'order_id'	         => $order_id,
					'invoice_no'         => $invoice_no,
					'date_added'         => date($this->language->get('date_format_short'), strtotime($order_info['date_added'])),
					'store_name'         => $order_info['store_name'],
					'store_url'          => rtrim($order_info['store_url'], '/'),
					'store_address'      => nl2br($store_address),
					'store_email'        => $store_email,
					'store_telephone'    => $store_telephone,
					'store_fax'          => $store_fax,
					'email'              => $order_info['email'],
					'telephone'          => $order_info['telephone'],
					'shipping_address'   => $shipping_address,
					'shipping_method'    => $order_info['shipping_method'],
					'product'            => $product_data,
					'comment'            => nl2br($order_info['comment'])
				);
			}
		}

		$this->response->setOutput($this->load->view('sale/vdi_order_shipping.tpl', $data));
	}

	public function api() {
		$json = array();
	
		// Store
		if (isset($this->request->get['store_id'])) {
			$store_id = $this->request->get['store_id'];
		} else {
			$store_id = 0;
		}

		$this->load->model('setting/store');

		$store_info = $this->model_setting_store->getStore($store_id);

		if ($store_info) {
			$url = $store_info['ssl'];
		} else {
			$url = HTTPS_CATALOG;
		}

		if (isset($this->session->data['cookie']) && isset($this->request->get['api'])) {
			// Include any URL perameters
			$url_data = array();

			foreach ($this->request->get as $key => $value) {
				if ($key != 'route' && $key != 'token' && $key != 'store_id') {
					$url_data[$key] = $value;
				}
			}

			$curl = curl_init();

			// Set SSL if required
			if (substr($url, 0, 5) == 'https') {
				curl_setopt($curl, CURLOPT_PORT, 443);
			}

			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLINFO_HEADER_OUT, true);
			curl_setopt($curl, CURLOPT_USERAGENT, $this->request->server['HTTP_USER_AGENT']);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_FORBID_REUSE, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_URL, $url . 'index.php?route=' . $this->request->get['api'] . ($url_data ? '&' . http_build_query($url_data) : ''));

			if ($this->request->post) {
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($this->request->post));
			}
		
			curl_setopt($curl, CURLOPT_COOKIE, session_name() . '=' . $this->session->data['cookie'] . ';');

			$json = curl_exec($curl);

			curl_close($curl);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput($json);
	}
}