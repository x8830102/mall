<?php
class ModelCatalogMVDBox extends Model {
	public function getVendorInfo($product_id) {
		$query = $this->db->query("SELECT *, vds.vendor_id as id, vds.date_add as registered FROM " . DB_PREFIX . "vendors vds LEFT JOIN " . DB_PREFIX . "vendor vd ON (vds.vendor_id = vd.vendor) WHERE vd.vproduct_id = '" . (int)$product_id . "'");		
		
		if ($query->row) {
			return array(
				'vendor_id'       	=> $query->row['id'],
				'vendor_name'     	=> $query->row['vendor_name'],
				'company_name'    	=> $query->row['company'],
				'company_id'     	=> $query->row['company_id'],
				'description'       => $query->row['vendor_description'],
				'registered'		=> date('Y', strtotime($query->row['registered'])),
				//'rating'			=> $this->getAVGRating($query->row['id']),
				'telephone' 		=> $query->row['telephone'],
				'fax'     			=> $query->row['fax'],
				'email'             => $query->row['email'],
				'paypal'            => $query->row['paypal_email'],
				'url'              	=> $query->row['store_url'],
				'image'             => $query->row['vendor_image'],
				'name'              => $query->row['lastname'] . ' ' . $query->row['firstname'],
				'geocode'			=> $query->row['geocode'],
				'address_1'         => $query->row['address_1'],
				'address_2'         => $query->row['address_2'],
				'postcode'         	=> $query->row['postcode'],
				'city'              => $query->row['city'],
				'zone_id'     		=> $query->row['zone_id'],
				'country_id'        => $query->row['country_id'],
				'zone'     			=> $this->getZone($query->row['zone_id']),
				'country'        	=> $this->getCountry($query->row['country_id'])
			);
		} else {
			return false;
		}
	}
	
	public function getInfoByVendorID($vendor_id) {
		$query = $this->db->query("SELECT *, vds.vendor_id as id, vds.date_add as registered FROM " . DB_PREFIX . "vendors vds WHERE vds.vendor_id = '" . (int)$vendor_id . "'");		
		
		if ($query->row) {
			return array(
				'vendor_id'       	=> $query->row['id'],
				'vendor_name'     	=> $query->row['vendor_name'],
				'company_name'    	=> $query->row['company'],
				'company_id'     	=> $query->row['company_id'],
				'description'       => $query->row['vendor_description'],
				'registered'		=> date('Y', strtotime($query->row['registered'])),
				//'rating'			=> $this->getAVGRating($query->row['id']),
				'telephone' 		=> $query->row['telephone'],
				'fax'     			=> $query->row['fax'],
				'email'             => $query->row['email'],
				'paypal'            => $query->row['paypal_email'],
				'url'              	=> $query->row['store_url'],
				'image'             => $query->row['vendor_image'],
				'name'              => $query->row['lastname'] . ' ' . $query->row['firstname'],
				'geocode'			=> $query->row['geocode'],
				'address_1'         => $query->row['address_1'],
				'address_2'         => $query->row['address_2'],
				'postcode'         	=> $query->row['postcode'],
				'city'              => $query->row['city'],
				'zone_id'     		=> $query->row['zone_id'],
				'country_id'        => $query->row['country_id'],
				'zone'     			=> $this->getZone($query->row['zone_id']),
				'country'        	=> $this->getCountry($query->row['country_id'])
			);
		} else {
			return false;
		}
	}
	
	/*private function getAVGRating($vendor_id) {
		$query = $this->db->query("SELECT AVG(rating_described) AS rating_described, AVG(rating_communication) AS rating_communication, AVG(rating_shipping) AS rating_shipping FROM " . DB_PREFIX . "seller_review WHERE status = '1' AND vendor_id = '" . (int)$this->db->escape(isset($vendor_id) ? (int)$vendor_id : 0) . "' GROUP BY vendor_id");	
		
		if ($query->row) {
			return array(
				'rating_described'		=> $query->row['rating_described'],
				'rating_communication'	=> $query->row['rating_communication'],
				'rating_shipping'		=> $query->row['rating_shipping'],
				'avg_rating'			=> round(($query->row['rating_described'] + $query->row['rating_communication'] + $query->row['rating_shipping'])/3,1)
			);
		} else {
			return false;
		}
	}
	
	public function getRatingStatus($vendor_id) {
		$query = $this->db->query("SELECT order_id, rating_described, rating_communication, rating_shipping FROM " . DB_PREFIX . "seller_review WHERE status = '1' AND vendor_id = '" . (int)$this->db->escape(isset($vendor_id) ? (int)$vendor_id : 0) . "' ORDER BY date_added DESC LIMIT 2");	
		
		if ($query->rows) {
			if(sizeof($query->rows) > 1) {
				$i=0;			
				foreach ($query->rows as $result) {
					if ($i==0) {
						$x = $result['rating_described'];
						$y = $result['rating_communication'];
						$z = $result['rating_shipping'];
					} else {
					
						if ($x > $result['rating_described']) {
							$rating_described = '<i class="fa fa-arrow-up"></i>';
						} elseif ($x < $result['rating_described']) {
							$rating_described = '<i class="fa fa-arrow-down"></i>';
						} else {
							$rating_described = '<i class="fa fa-ellipsis-h"></i>';
						}
						
						if ($y > $result['rating_communication']) {
							$rating_communication = '<i class="fa fa-arrow-up"></i>';
						} elseif ($y < $result['rating_communication']) {
							$rating_communication = '<i class="fa fa-arrow-down"></i>';
						} else {
							$rating_communication = '<i class="fa fa-ellipsis-h"></i>';
						}
						
						if ($z > $result['rating_shipping']) {
							$rating_shipping = '<i class="fa fa-arrow-up"></i>';
						} elseif ($z < $result['rating_shipping']) {
							$rating_shipping = '<i class="fa fa-arrow-down"></i>';
						} else {
							$rating_shipping = '<i class="fa fa-ellipsis-h"></i>';
						}
					}
					$i++;
				}
				
				return array(
					'described_status'		=> $rating_described,
					'communication_status'	=> $rating_communication,
					'shipping_status'		=> $rating_shipping
				);
			
			} elseif (sizeof($query->rows) == 1) {
				//up 1 , down 0 , equal = 2
				return array(
					'described_status'		=> '<i class="fa fa-arrow-up"></i>',
					'communication_status'	=> '<i class="fa fa-arrow-up"></i>',
					'shipping_status'		=> '<i class="fa fa-arrow-up"></i>'
				);
			} else {
				return array(
					'described_status'		=> '<i class="fa fa-ellipsis-h"></i>',
					'communication_status'	=> '<i class="fa fa-ellipsis-h"></i>',
					'shipping_status'		=> '<i class="fa fa-ellipsis-h"></i>'
				);
			}
		} else {
			return array(
					'described_status'		=> '<i class="fa fa-ellipsis-h"></i>',
					'communication_status'	=> '<i class="fa fa-ellipsis-h"></i>',
					'shipping_status'		=> '<i class="fa fa-ellipsis-h"></i>'
				);
		}
	}*/
	
	public function getSellerCommentByProductId($product_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT r.review_id, r.rating_described, r.customer_id, r.text, p.product_id, pd.name, p.price, p.image, r.date_added FROM " . DB_PREFIX . "seller_review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	
	public function getQuestionAnswerByProductId($product_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT qa.question_answer_id, vds.vendor_name, qa.product_id, qa.text, qa.customer_id, qa.reply_text, qa.date_added,qa.date_modified FROM " . DB_PREFIX . "question_answer qa LEFT JOIN " . DB_PREFIX . "product p ON (qa.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "vendors vds ON (qa.vendor_id = vds.vendor_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND qa.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY qa.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}
	
	public function writeQuestion($product_id,$vendor_id,$data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "question_answer SET customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['question']) . "', vendor_id = '" . (isset($vendor_id) ? (int)$vendor_id : '0') . "', status = '1', date_added = NOW()");
		
		if (isset($vendor_id)) {
			$vdata = $this->db->query("SELECT CONCAT(firstname, ' ', lastname) as name, email FROM " . DB_PREFIX . "vendors WHERE vendor_id = '" . (int)$vendor_id . "'");
			$cdata = $this->db->query("SELECT CONCAT(firstname, ' ', lastname) as name, email FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$this->customer->getId() . "'");
			
			$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
				
			$message  = sprintf($this->language->get('text_dear'),$vdata->row['name']) . "\n\n";
			$message .= sprintf($this->language->get('text_message_title'),$cdata->row['name']) . "\n\n";
			$message .= html_entity_decode($data['question'], ENT_QUOTES, 'UTF-8') . "\n\n";			
			$message .= $this->url->link('product/product', 'product_id=' . $product_id) . "\n\n";
			$message .= $this->language->get('text_send_from') . "\n";
			$message .= html_entity_decode($cdata->row['name'], ENT_QUOTES, 'UTF-8') . "\n\n";
			$message .= $this->language->get('text_auto_msg');

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo((isset($vdata->row['email']) ? $vdata->row['email'] : $this->config->get('config_email')));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setText($message);
			$mail->send();
			
			// Send to additional alert emails
				if ($this->config->get('mvd_seller_review_store_email')) {
					$emails = explode(',', $this->config->get('config_email'));

					foreach ($emails as $email) {
						if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
							$mail->setTo($email);
							$mail->send();
						}
					}
				}
		}
	}
	
	public function getTotalSellerCommentByProductId($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "seller_review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
	
	public function getTotalQuestionAnswerByProductId($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "question_answer qa LEFT JOIN " . DB_PREFIX . "product p ON (qa.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND qa.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
	
	public function getCustomerName($customer_id) {
		$query = $this->db->query("SELECT CONCAT(firstname, ' ', lastname) AS name FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		
		$name = $this->mask_name($query->row['name'], '*', $percent=50);
					
		return $name;
	}
	
	public function getRealName($customer_id) {
		$query = $this->db->query("SELECT CONCAT(firstname, ' ', lastname) AS name FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");			
		return $query->row['name'];
	}
	
	public function mask_name($name, $mask_char, $percent=50) {   
		$user = $name; 
		$len = strlen($user); 
		$mask_count = floor($len * $percent /100); 
		$offset = floor(($len - $mask_count )/2);

		$masked = substr($user,0,$offset) . str_repeat($mask_char,$mask_count) . substr($user,$mask_count+$offset); 
		return $masked;
    }
	
	private function getCountry($country_id) {
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "country WHERE country_id = '" . (int)$country_id . "' AND status = '1'");
		
		if (isset($query->row['name'])) {
			return $query->row['name'];
		} else {
			return false;
		}
		
	}
	
	private function getZone($zone_id) {
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "' AND status = '1'");
		
		if (isset($query->row['name'])) {
			return $query->row['name'];
		} else {
			return false;
		}
	}
	
	public function getTotalVendorOrdersDetail($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total, SUM(quantity) as quantity FROM " . DB_PREFIX . "order_product WHERE order_status_id > 0 AND product_id = '" . (int)$this->db->escape($product_id) . "' GROUP BY product_id");
		if ($query->row) {
			return $query->row;
		} else {
			return false;
		}
	}
	
	public function getTotalVendorTransactions($vendor_id) {
		$query = $this->db->query("SELECT COUNT(DISTINCT order_id) AS total, SUM(quantity) as quantity FROM " . DB_PREFIX . "order_product WHERE order_status_id > 0 AND vendor_id = '" . (int)$this->db->escape($vendor_id) . "'");
		if ($query->row) {
			return $query->row;
		} else {
			return false;
		}
	}
	
	public function getVendorId($product_id) {
		$query = $this->db->query("SELECT vendor FROM " . DB_PREFIX . "vendor WHERE vproduct_id = '" . (int)$this->db->escape($product_id) . "'");
		if ($query->row) {
			return $query->row['vendor'];
		} else {
			return false;
		}
	}
}
?>