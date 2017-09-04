<?php 
class ModelPaymentSuntechWebatm extends Model {
  	public function getMethod($address, $total) {
		$this->load->language('payment/suntech_webatm');
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('suntech_webatm_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");
		
		if (!$this->config->get('suntech_webatm_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}	
		
		$method_data = array();
	
		if ($status) {  
      		$method_data = array( 
        		'code'       => 'suntech_webatm',
        		'title'      => $this->language->get('text_title'),
        		'terms' => '',
				'sort_order' => $this->config->get('suntech_webatm_sort_order')
      		);
    	}

        if ($this->config->get('suntech_webatm_cargo_option')) {
            $method_data['title'] .= "<p style='display: inline;color: tomato;'>（下一步可選擇是否<b>超商取貨</b>)</p>";
        }

    	return $method_data;
  	}

    public function setOrderTotalsWithSunShip($order_id, $total_amount)
    {
        $this->load->language('payment/suntech_webatm');

        /*
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' AND code = 'shipping'");
        $original_shipping_cost = $query->row['value'];
        $sun_shipping_cost = $this->config->get('suntech_buysafe_sun_shipping_cost');
        $sun_shipping_title = $this->language->get('sun_shipping_title');
        $new_shipping_cost = (int)$sun_shipping_cost - (int)$original_shipping_cost;
        $new_total = $total_amount + $new_shipping_cost;
        */

        /*
        // 更新order_total運送方式及運費
        $this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET title = '" . $this->db->escape($sun_shipping_title) . "', value = '" . (int)$sun_shipping_cost . "' WHERE order_id = '" . (int)$order_id . "' AND code = 'shipping'");
        // 更新order_total總金額
        $this->db->query("UPDATE `" . DB_PREFIX . "order_total` SET value = '" . (int)$new_total . "' WHERE order_id = '" . (int)$order_id . "' AND code = 'total'");
        */

        // 取消更新總金額，沿用原本金額
        $new_total = $total_amount;

        // 更新order運送方式及總金額
        $shipping_info = array(
            'shipping_company' => '',
            'shipping_address_1' => $this->language->get('cargo_text'),
            'shipping_address_2' => '',
            'shipping_city' => '',
            'shipping_postcode' => '',
            'shipping_zone' => '',
            'shipping_zone_id' => '0',
            'shipping_method' => $this->language->get('cargo_text'),
            'shipping_code' => '7-11',
            'total' => $new_total
        );

        $this->setOrderInfo($order_id, $shipping_info);

        return $new_total;
    }

    public function setOrderInfo($order_id, $order_data)
    {
        $update_column = '';
        end($order_data);
        $last_key = key($order_data);

        foreach ($order_data as $key => $info) {
            $update_column .= $key . " = '" . $this->db->escape($info) . "'";
            if ($key != $last_key) {
                $update_column .= ", ";
            }
        }

        $query = "UPDATE `" . DB_PREFIX . "order` SET " . $update_column . " WHERE order_id = '" . (int)$order_id . "'";
        $this->db->query($query);
    }

    public function includeSunPay() {
        if (!class_exists('SunPay', false)) {
            if (!include('sunpay.php')) {
                $this->load->language('payment/suntech');
                return false;
            }
        }
        return true;
    }
}
?>