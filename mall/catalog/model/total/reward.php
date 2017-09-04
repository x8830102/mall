<?php
class ModelTotalReward extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if (isset($this->session->data['reward'])) {
			$this->load->language('total/reward');

			$points = $this->customer->getRewardPoints();

			if ($this->session->data['reward'] <= $points) {
				$discount_total = 0;

				$points_total = 0;

				foreach ($this->cart->getProducts() as $product) {
					if ($product['points']) {
						$points_total += $product['points'];
					}
				}

				$points = min($points, $points_total);

				foreach ($this->cart->getProducts() as $product) {
					$discount = 0;

					if ($product['points']) {
						$discount = $product['total'] * ($this->session->data['reward'] / $points_total);

						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

							foreach ($tax_rates as $tax_rate) {
								if ($tax_rate['type'] == 'P') {
									$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
								}
							}
						}
					}

					$discount_total += $discount;
				}

				$total_data[] = array(
					'code'       => 'reward',
					'title'      => sprintf($this->language->get('text_reward'), $this->session->data['reward']),
					'value'      => -$discount_total,
					'sort_order' => $this->config->get('reward_sort_order')
				);

				$total -= $discount_total;
			}
		}
	}

	public function confirm($order_info, $order_total) {
		/*include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$this->load->language('total/reward');

		$points = 0;

		$start = strpos($order_total['title'], '(') + 1;
		$end = strrpos($order_total['title'], ')');

		if ($start && $end) {
			$points = substr($order_total['title'], $start, $end - $start);
		}

		$query = $pdo_oc->query("SELECT number FROM " . DB_PREFIX . "customer WHERE customer_id = '" . $order_info['customer_id'] . "' AND status = '1'");
		$number = $query->fetch();

		if ($points) {
			$query = $pdo_cmg->query("INSERT INTO r_cash SET number = '" . $number['number'] . "', 
				note = '於購物商城消費" . (float)$points . "點<br>訂單編號" . (int)$order_info['order_id'] . "',
				note2 = '". (int)$order_info['order_id'] . "',
				cout = '" . (float)$points . "', 
				csum = ((SELECT csum FROM (SELECT csum FROM r_cash WHERE number = '" . $number['number'] . "' ORDER BY id DESC limit 1) AS csum)-". (float)$points ."), 
				date = CURDATE(), 
				time = CURTIME()");
		}

		$pdo_cmg = NULL;*/
	}

	public function unconfirm($order_id) {
		include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$search = $pdo_cmg->query("SELECT cin,cout,number FROM r_cash WHERE note2 = '" . (int)$order_id . "' ORDER BY id DESC limit 1");
		$points = $search->fetch();
		if($points['cout'] > 0){
			$query = $pdo_cmg->query("INSERT INTO r_cash SET number = '" . $points['number'] . "', 
					note = '於購物商城退費" . (float)$points['cout'] . "點<br>訂單編號" . (int)$order_id . "',
					note2 = '". (int)$order_id . "',
					cin = '" . (float)$points['cout'] . "', 
					csum = ((SELECT csum FROM (SELECT csum FROM r_cash WHERE number = '" . $points['number'] . "' ORDER BY id DESC limit 1) AS csum)+". (float)$points['cout'] ."),
					date = CURDATE(), 
					time = CURTIME()");
		}
		$pdo_cmg = NULL;
	}
}