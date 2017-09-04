<?php
class ModelAccountCustomer extends Model {
	public function addCustomer($data) {
		include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$this->event->trigger('pre.customer.add', $data);

		if (isset($data['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($data['customer_group_id'], $this->config->get('config_customer_group_display'))) {
			$customer_group_id = $data['customer_group_id'];
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$this->load->model('account/customer_group');

		$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

		//get fname & fnumber
		if(!empty($data['fname'])){	
			$fname = $data['fname'];
		}else{
			$fname = 'lifelink';
		}
		$query_fnumber = $pdo_cmg ->query("SELECT number FROM memberdata WHERE m_username = '".$fname."'");
		$query_fnumber = $query_fnumber->fetch();
		$fnumber = $query_fnumber['number'];
		
		//get number & card
	    $query_Reci = $pdo_cmg ->query("SELECT * FROM admin WHERE username='boss'");
	    $num_query = $query_Reci->fetch();
	    $num_box=$num_query['num_box'];
	    $num_z=$num_query['num_z'];
	    if(date("m") != $num_z) {
		   $numz=date("m");
		   $update11= $pdo_cmg ->query("UPDATE admin SET num_z=$numz WHERE username='boss'");
		   $num_box=1;
		   }
	    if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}
	    if ($num_box < 10) {$number="SN".date("ymd")."000".$num_box;$card=date("ym")."000".$num_box;}
	    if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."00".$num_box;$card=date("ym")."00".$num_box;}
	    if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."0".$num_box;$card=date("ym")."0".$num_box;}
		if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd").$num_box;$card=date("ym").$num_box;}
		$new_num_box=$num_box+1;
	    $update11 = $pdo_cmg->query("UPDATE admin SET num_box=$new_num_box WHERE username='boss'");

		//$birthday = $data['birthday'];
		//$gender = $data['gender'];

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer SET customer_group_id = '" . (int)$customer_group_id . "', store_id = '" . (int)$this->config->get('config_store_id') . "', number = '$number', m_username = '" . $this->db->escape($data['username']) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['account']) ? serialize($data['custom_field']['account']) : '') . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', newsletter = '" . (isset($data['newsletter']) ? (int)$data['newsletter'] : 0) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', status = '1', approved = '" . (int)!$customer_group_info['approval'] . "', date_added = NOW()");
		//to cmg
		$stmt = $pdo_cmg->prepare("INSERT INTO memberdata (m_name, m_email, m_callphone, m_passwd, m_username, m_joinDate,fname,m_passtoo, m_guser, a_pud, date, time, number, card, m_ok) VALUE(?, ?, ?, ?, ?, NOW(), ?, ?, ?, 1, NOW(), CURTIME(), ?, ?, 1)");
		$stmt->bindParam(1, $m_name);
		$stmt->bindParam(2, $email);
		$stmt->bindParam(3, $telephone);
		$stmt->bindParam(4, $password);
		$stmt->bindParam(5, $username);
		$stmt->bindParam(6, $fname);
		$stmt->bindParam(7, $password);
		$stmt->bindParam(8, $fnumber);
		$stmt->bindParam(9, $number);
		$stmt->bindParam(10, $card);
		//$stmt->bindParam(9, $birthday);
		//$stmt->bindParam(10, $gender);

		$m_name = $data['lastname'].$data['firstname'];
		$email = $data['email'];
		$telephone = $data['telephone'];
		$password = $data['password'];
		$username = $data['username'];

		
		$stmt->execute();

		/*發紅利*/
		$gk=3;
		unset($gg);
		$gg=array(300,150,100);
		$gi=0;
		$ga=$username;
		$year=date("Y");
		$moom=date("m");
		$day=date("d");
		$z=date("z");
		$date=date("Y-m-d");
		$time=date("H:i:s");
		$ganame=$username;
		while ($gk != 0) {
	        $query_Recb3 = $pdo_cmg->query("SELECT * FROM memberdata WHERE m_username = '$ga'");
	        $row_Recb3 = $query_Recb3->fetch();
		    $bnum=$row_Recb3['number'];//echo $bnum;exit;

	        $query_Recr2 = $pdo_cmg->query("SELECT * FROM r_cash WHERE number = '$bnum' ORDER BY id DESC");
	        $row_Recr2 = $query_Recr2->fetch();
			$ggv=$gg[$gi];
			if($row_Recr2['csum']){
				$gs=$row_Recr2['csum'];
			} else {
				$gs=0;
			}
			$new_ggv=$gs+$ggv;//echo $ggv,"##",$gs,"<br/>";
			$y_note=$ganame."<br/>粉絲加入贈紅利".$ggv;
			$sncode=$bnum."-".date("ymdhis");
	        $insertCommand13 = $pdo_cmg->query("INSERT INTO r_cash (number, cin, csum, note, date, time, sncode) VALUES ('$bnum', '$ggv', '$new_ggv', '$y_note', '$date', '$time', '$sncode')"); 
			//goldf
			$gold_f=$ggv;$glevel=6;$at=1;
		    $fnote="粉絲加入贈紅利".$ggv;
		    
	        $insertCommand15 = $pdo_cmg->query("INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$bnum', '$year', '$moom', '$day', '$z', '$gold_f', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"); 
		    //
	    $query_Recs = $pdo_cmg->query("SELECT * FROM gold_sum WHERE number = '$bnum' && year=$year && moom=$moom && day=$day");
	    $row_Recs = $query_Recs->fetch();
	    if (empty($row_Recs)) {
	        $insertCommand15 = $pdo_cmg->query("INSERT INTO gold_sum (number, year, moom, day, z, level6) VALUES ('$bnum', '$year', '$moom', '$day', '$z', '$gold_f')");
	        } else {
		        $new_level1=$row_Recs['level6']+$gold_f;
		        $update11 = $pdo_cmg->query("UPDATE gold_sum SET level6= $new_level1 WHERE number = '$bnum' && year=$year && moom=$moom && day=$day");
		    }
			$gk--;$gi++;
			if($row_Recb3['fname'] != ""){
				$ga=$row_Recb3['fname'];
			} else {
				break;
			}
		}//exit;
		$pdo_cmg = NULL;




		$customer_id = $this->db->getLastId();

		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', company = '" . $this->db->escape($data['company']) . "', address_1 = '" . $this->db->escape($data['address_1']) . "', address_2 = '" . $this->db->escape($data['address_2']) . "', city = '" . $this->db->escape($data['city']) . "', postcode = '" . $this->db->escape($data['postcode']) . "', country_id = '" . (int)$data['country_id'] . "', zone_id = '" . (int)$data['zone_id'] . "', custom_field = '" . $this->db->escape(isset($data['custom_field']['address']) ? serialize($data['custom_field']['address']) : '') . "'");

		$address_id = $this->db->getLastId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$this->load->language('mail/customer');

		$subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));

		$message = sprintf($this->language->get('text_welcome'), $this->config->get('config_name')) . "\n\n";

		if (!$customer_group_info['approval']) {
			$message .= $this->language->get('text_login') . "\n";
		} else {
			$message .= $this->language->get('text_approval') . "\n";
		}

		$message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
		$message .= $this->language->get('text_services') . "\n\n";
		$message .= $this->language->get('text_thanks') . "\n";
		$message .= $this->config->get('config_name');

		$mail = new Mail();
		$mail->protocol = $this->config->get('config_mail_protocol');
		$mail->parameter = $this->config->get('config_mail_parameter');
		$mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
		$mail->smtp_username = $this->config->get('config_mail_smtp_username');
		$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
		$mail->smtp_port = $this->config->get('config_mail_smtp_port');
		$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			
		$mail->setTo($data['email']);
		$mail->setFrom($this->config->get('config_email'));
		$mail->setSender($this->config->get('config_name'));
		$mail->setSubject($subject);
		$mail->setText($message);
		$mail->send();

		// Send to main admin email if new account email is enabled
		if ($this->config->get('config_account_mail')) {
			$message  = $this->language->get('text_signup') . "\n\n";
			$message .= $this->language->get('text_website') . ' ' . $this->config->get('config_name') . "\n";
			$message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
			$message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
			$message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
			$message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
			$message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_host');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
            
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->request->post['email']);
			$mail->setSender($this->request->post['name']);
			$mail->setSubject($this->language->get('text_new_customer'));
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails if new account email is enabled
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if (utf8_strlen($email) > 0 && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		$this->event->trigger('post.customer.add', $customer_id);

		return $customer_id;
	}

	public function editCustomer($data) {
		include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$this->event->trigger('pre.customer.edit', $data);

		$customer_id = $this->customer->getId();

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', fax = '" . $this->db->escape($data['fax']) . "', custom_field = '" . $this->db->escape(isset($data['custom_field']) ? serialize($data['custom_field']) : '') . "' WHERE customer_id = '" . (int)$customer_id . "'");

		$stmt = $pdo_cmg->query("UPDATE memberdata SET m_email = '" . $data['email'] . "', m_callphone = '" . $data['telephone'] . "' WHERE m_username = '".$data['username']."'");
		$stmt = $pdo_f->query("UPDATE wp_users SET user_email = '" . $data['email'] . "' WHERE user_login = '".$data['username']."'");
		$stmt = $pdo_cc->query("UPDATE wp_users SET user_email = '" . $data['email'] . "' WHERE user_login = '".$data['username']."'");

		$this->event->trigger('post.customer.edit', $customer_id);
	}

	public function editPassword($email, $password) {
		include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$this->event->trigger('pre.customer.edit.password');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "' WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		$stmt = $pdo_cmg->query("UPDATE memberdata SET m_passwd = '".$password."' WHERE m_email = '".$email."'");
		$stmt = $pdo_f->query("UPDATE wp_users SET user_pass = '".MD5($password)."' WHERE user_email = '".$email."'");
		$stmt = $pdo_cc->query("UPDATE wp_users SET user_pass = '".MD5($password)."' WHERE user_email = '".$email."'");

		$this->event->trigger('post.customer.edit.password');
	}

	public function editNewsletter($newsletter) {
		$this->event->trigger('pre.customer.edit.newsletter');

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET newsletter = '" . (int)$newsletter . "' WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		$this->event->trigger('post.customer.edit.newsletter');
	}

	public function getCustomer($customer_id) {
		include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		$value = get_object_vars($query);
		$username = $pdo_cmg -> query("SELECT m_username AS username FROM memberdata WHERE m_email ='".$value['row']['email']."'");
		$username = $username->fetch();
		$query->row = array_merge($query->row,$username);
		
		//return $usernameqr['username']->row;
		return $query->row;

	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomerByToken($token) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer WHERE token = '" . $this->db->escape($token) . "' AND token != ''");

		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = ''");

		return $query->row;
	}

	public function getTotalCustomersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
	public function getTotalCustomersByUsername($username) {
	include($_SERVER['DOCUMENT_ROOT']."/pdo_cmg.php");
		$stmt = $pdo_cmg->prepare("SELECT m_username FROM memberdata WHERE m_username = ?");
		$stmt->bindParam(1, $username);

		$query = $stmt->execute();
		$pdo_cmg = NULL;

		return $query;
	}

	public function getIps($customer_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ip` WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->rows;
	}

	public function isBanIp($ip) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_ban_ip` WHERE ip = '" . $this->db->escape($ip) . "'");

		return $query->num_rows;
	}
	
	public function addLoginAttempt($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_login WHERE email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "' AND ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'");
		
		if (!$query->num_rows) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "customer_login SET email = '" . $this->db->escape(utf8_strtolower((string)$email)) . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "', total = 1, date_added = '" . $this->db->escape(date('Y-m-d H:i:s')) . "', date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "'");
		} else {
			$this->db->query("UPDATE " . DB_PREFIX . "customer_login SET total = (total + 1), date_modified = '" . $this->db->escape(date('Y-m-d H:i:s')) . "' WHERE customer_login_id = '" . (int)$query->row['customer_login_id'] . "'");
		}			
	}	
	
	public function getLoginAttempts($email) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}
	
	public function deleteLoginAttempts($email) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_login` WHERE email = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}	
}