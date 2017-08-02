<?php 
class Reservoir{

	function new_in($new_number,$new_card,$new_pud,$Tnumber,$notpay,$fnumber2,$businessRatio,$districtRatio,$district){
		/**新單水庫
		* new_number	新註冊編號
		* new_card		新註冊card
		* new_pud		購買專案
		* Tnumber		講師
		* notpay		已付金額
		**/
		$businessRatio = explode(",",$businessRatio);
		$districtRatio = explode(",",$districtRatio);
		date_default_timezone_set('Asia/Taipei');
		include('Connections/sc.php');mysql_query("set names utf8");
		$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
		
		mysql_select_db($database_sc, $sc);
		$select_username = "SELECT * FROM memberdata WHERE number = '$new_number'";
		$query_username = mysql_query($select_username) or die(mysql_error());
		$row_username = mysql_fetch_assoc($query_username);
		if($new_pud ==8)
		{
			$notpay = 21100;
			$select_apud = "SELECT * FROM a_pud WHERE id = $new_pud";
			$query_apud = mysql_query($select_apud, $sc) or die(mysql_error());
			$row_apud = mysql_fetch_assoc($query_apud);
			$num_apud = mysql_num_rows($query_apud);
			$pay_a = $row_apud['p'];
			$pay_b = $row_apud['b'];
			$pay_e = $row_apud['e'];
			$pay_n = $row_apud['n'];
		}else{
			$select_apud = "SELECT * FROM a_pud WHERE id = $new_pud";
			$query_apud = mysql_query($select_apud, $sc) or die(mysql_error());
			$row_apud = mysql_fetch_assoc($query_apud);
			$num_apud = mysql_num_rows($query_apud);
			
			$pud_name = $row_apud['name']."(新單入單):".$row_username['m_username'];
			$pay_a = $row_apud['p'];
			$pay_da = $row_apud['d_a'];
			$pay_db = $row_apud['d_b'];
			$pay_dc = $row_apud['d_c'];
			$pay_dd = $row_apud['d_d'];
			$pay_e = $row_apud['e'];
			$pay_i = $row_apud['i'];
			$pay_b = $row_apud['b'];
			$pay_g = $row_apud['g'];
			$pay_h = $row_apud['h'];
			$pay_c = $row_apud['c'];
			$pay_j = $row_apud['j'];
			$pay_k = $row_apud['k'];
			$pay_d = $row_apud['d'];
			$pay_f = $row_apud['f'];
			$pay_o = $row_apud['o'];
			$pay_q = $row_apud['q'];
			$pay_n = $row_apud['n'];
		
		}
		$select_md = "SELECT * FROM memberdata WHERE number = '$new_number' ";
		$query_md = mysql_query($select_md, $sc) or die(mysql_error());
		$row_md = mysql_fetch_assoc($query_md);
		$num_md = mysql_num_rows($query_md);
		$newuser = $row_md['m_username'];//新單帳號
		$fname = $row_md['fname'];//推薦人
		//$guser = $row_md['m_guser'];
		$fnumber = $row_md['m_fuser'];
		$total = 0;
		if(isset($notpay) && $notpay != "")
		{	
			$pud_name = $row_apud['name']."(福音專案):".$row_username['m_username'];
			$gold = $notpay;
		}else{
			$gold = $pay_a;
		}
		//收費總庫
		
			$select_a = "SELECT * FROM pay_a ORDER BY id DESC";
			$query_a = mysql_query($select_a, $sc) or die(mysql_error());
			$row_a = mysql_fetch_assoc($query_a);
			$num_a = mysql_num_rows($query_a);
			if($num_a == 0)
			{
				$psum = 0;
				$psum = $pay_a + $psum;
			}else{
				$psum = $row_a['psum'];
				$psum = $pay_a + $psum;
			}
			$insert_pay_a = "INSERT INTO pay_a (pin,psum,number,card,at,date,time,pud_name) VALUES ('$gold','$psum','$fnumber','$new_card',1,'$date','$time','$pud_name')";
			$query_ina = mysql_query($insert_pay_a, $sc) or die(mysql_error());	

		//
		//組織福袋20000
		if($pay_b !=0 && $gold > 0)
		{
			$select_b = "SELECT * FROM pay_b ORDER BY id DESC";
			$query_b = mysql_query($select_b, $sc) or die(mysql_error());
			$row_b = mysql_fetch_assoc($query_b);
			$num_b = mysql_num_rows($query_b);
			if($num_b == 0)
			{
				$psum = 0;
				$psum = $pay_b + $psum;
			}else{
				$psum = $row_b['psum'];
				$psum = $pay_b + $psum;
			}
			
			$insert_pay_b = "INSERT INTO pay_b (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_b','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_inb = mysql_query($insert_pay_b, $sc) or die(mysql_error());
			$gold = $gold - $pay_b;
			$total = $total + $pay_b;
			echo "pay_b:".$gold."<br>";
		}
		//
		//愛心公益100
		if($pay_e !=0 && $gold > 0)
		{
			$select_e = "SELECT * FROM pay_e ORDER BY id DESC";
			$query_e = mysql_query($select_e, $sc) or die(mysql_error());
			$row_e = mysql_fetch_assoc($query_e);
			$num_e = mysql_num_rows($query_e);
			if($num_e == 0)
			{
				$psum = 0;
				$psum = $pay_e + $psum;
			}else{
				$psum = $row_e['psum'];
				$psum = $pay_e + $psum;
			}
			
			$insert_pay_e = "INSERT INTO pay_e (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_e','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_ine = mysql_query($insert_pay_e, $sc) or die(mysql_error());
			$gold = $gold - $pay_e;
			$total = $total + $pay_e;
		}
		//
		//社群組織領導
		if($pay_n !=0 && $gold > 0)
		{
			if($gold - $pay_n >=0)
			{
				$gold = $gold - $pay_n;
			}else{
				$pay_n = $gold;
				$gold = $gold - $gold ;
			}
			$select_d = "SELECT * FROM pay_n ORDER BY id DESC";
			$query_d = mysql_query($select_d, $sc) or die(mysql_error());
			$row_d = mysql_fetch_assoc($query_d);
			$num_d = mysql_num_rows($query_d);
			if($num_d == 0)
			{
				$psum = 0;
				$psum = $pay_n + $psum;
			}else{
				$psum = $row_d['psum'];
				$psum = $pay_n + $psum;
			}
			$insert_pay_d = "INSERT INTO pay_n (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_n','$psum','$new_number','$new_dard',1,'$date','$time','$pud_name')";
			$query_ind = mysql_query($insert_pay_d, $sc) or die(mysql_error());	
			$total = $total + $pay_n;
		}
		//組織運作1000
		if($pay_d !=0 && $gold > 0)
		{
			if($gold - $pay_d >=0)
			{
				$gold = $gold - $pay_d;
			}else{
				$pay_d = $gold;
				$gold = $gold - $gold ;
			}
			$select_d = "SELECT * FROM pay_d ORDER BY id DESC";
			$query_d = mysql_query($select_d, $sc) or die(mysql_error());
			$row_d = mysql_fetch_assoc($query_d);
			$num_d = mysql_num_rows($query_d);
			if($num_d == 0)
			{
				$psum = 0;
				$psum = $pay_d + $psum;
			}else{
				$psum = $row_d['psum'];
				$psum = $pay_d + $psum;
			}
			$insert_pay_d = "INSERT INTO pay_d (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_d','$psum','$new_number','$new_dard',1,'$date','$time','$pud_name')";
			$query_ind = mysql_query($insert_pay_d, $sc) or die(mysql_error());	
			$total = $total + $pay_d;
		}
		//
		//講師2500
		if($pay_q != 0 && $gold > 0)
		{
			$note = "教育積分<br>帳號:".$newuser;
			$sncode=$Tnumber."-".date("ymdhis");
			$glevel = 3;
			$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$Tnumber', '$year', '$moom', '$day', '$z', '$pay_q', '$note', '$glevel', '0', '$date', '$time', '$sncode')"; 
			mysql_query($insertpud7,$sc);
			$gold = $gold - $pay_q;
			$total = $total + $pay_q;
		}
		//
		//靜態2.5%特別分紅3000
		if($pay_c != 0 && $gold > 0 )
		{
			$select_c = "SELECT * FROM pay_c ORDER BY id DESC";
			$query_c = mysql_query($select_c, $sc) or die(mysql_error());
			$row_c = mysql_fetch_assoc($query_c);
			$num_c = mysql_num_rows($query_c);
			if($num_c == 0)
			{
				$psum = 0;
				$psum = $pay_c + $psum;
			}else{
				$psum = $row_c['psum'];
				$psum = $pay_c + $psum;
			}
			$insert_pay_c = "INSERT INTO pay_c (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_c','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_inc = mysql_query($insert_pay_c, $sc) or die(mysql_error());
			$gold = $gold - $pay_c;
			$total = $total + $pay_c;
		}
		
		
		//場地
		if($pay_o != 0 && $gold >0)
		{
			if(!empty($district)){
				$select = "SELECT `csum` FROM `c_cash` WHERE `number`='$district'  ORDER BY id DESC";
				$query = mysql_query($select,$sc)or die(mysql_error());
				$resultc = mysql_fetch_assoc($query);
				$c_count = mysql_num_rows($query);
				$select = "SELECT `csum` FROM `g_cash` WHERE `number`='$district'  ORDER BY id DESC";
				$query = mysql_query($select,$sc)or die(mysql_error());
				$resultg = mysql_fetch_assoc($query);
				$g_count = mysql_num_rows($query);
				$note = "場地積分<br>帳號:".$newuser;
				$csum = $c_count == 0? 0:$resultc['csum'];
				$gsum = $g_count == 0? 0:$resultg['csum'];
				$c_in = $pay_o * ($districtRatio[0]*10/100);
				$g_in = $pay_o * ($districtRatio[1]*10/100);
				$csum = $csum + $c_in;
				$gsum = $gsum + $g_in;
				
				$insert_pay_o = "INSERT INTO c_cash (number,cin,csum,note,date,time) VALUES ('$district','$c_in','$csum','$note','$date','$time')";
				$query_ino = mysql_query($insert_pay_o, $sc) or die(mysql_error());
				$insert_pay_o = "INSERT INTO g_cash (number,cin,csum,note,date,time) VALUES ('$district','$g_in','$gsum','$note','$date','$time')";
				$query_ino = mysql_query($insert_pay_o, $sc) or die(mysql_error());
			}else{
				$select_o = "SELECT * FROM pay_o ORDER BY id DESC";
				$query_o = mysql_query($select_o, $sc) or die(mysql_error());
				$row_o = mysql_fetch_assoc($query_o);
				$num_o = mysql_num_rows($query_o);
				if($num_o == 0)
				{
					$psum = 0;
					$psum = $pay_o + $psum;
				}else{
					$psum = $row_o['psum'];
					$psum = $pay_o + $psum;
				}
			
				$insert_pay_o = "INSERT INTO pay_o (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_o','$psum','$new_number','$new_fard',1,'$date','$time','$pud_name')";
				$query_ino = mysql_query($insert_pay_o, $sc) or die(mysql_error());
			}
			$gold = $gold - $pay_o;
			$total = $total + $pay_o;
		}
		//
		//銀行紅陽刷卡2.8%
		if($pay_db != 0 && $gold > 0)
		{
			$select_db = "SELECT * FROM pay_db ORDER BY id DESC";
			$query_db = mysql_query($select_db, $sc) or die(mysql_error());
			$row_db = mysql_fetch_assoc($query_db);
			$num_db = mysql_num_rows($query_db);
			if($num_db == 0)
			{
				$psum = 0;
				$psum = $pay_db + $psum;
			}else{
				$psum = $row_db['psum'];
				$psum = $pay_db + $psum;
			}
			
			$insert_pay_db = "INSERT INTO pay_db (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_db','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_indb = mysql_query($insert_pay_db, $sc) or die(mysql_error());
			$gold = $gold - $pay_db;
			$total = $total + $pay_db;
		}
		//
		//系統開發建置費20%
		if($pay_dc !=0 && $gold > 0)
		{
		    if($gold - $pay_dc >=0)
			{
				$gold = $gold - $pay_dc;
			}else{
				$pay_dc = $gold;
				$gold = $gold - $gold ;
			}
			$select_dc = "SELECT * FROM pay_dc ORDER BY id DESC";
			$query_dc = mysql_query($select_dc, $sc) or die(mysql_error());
			$row_dc = mysql_fetch_assoc($query_dc);
			$num_dc = mysql_num_rows($query_dc);
			if($num_dc == 0)
			{
				$psum = 0;
				$psum = $pay_dc + $psum;
			}else{
				$psum = $row_dc['psum'];
				$psum = $pay_dc + $psum;
			}
			
			$insert_pay_dc = "INSERT INTO pay_dc (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_dc','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_indc = mysql_query($insert_pay_dc, $sc) or die(mysql_error());
			$total = $total + $pay_dc;
		}
		//
		//人事管銷雜項
		if($pay_dd != 0 && $gold > 0)
		{
			if($gold - $pay_dd >=0)
			{
				$gold = $gold - $pay_dd;
			}else{
				$pay_dd = $gold;
				$gold = $gold - $gold ;
			}
			$select_dd = "SELECT * FROM pay_dd ORDER BY id DESC";
			$query_dd = mysql_query($select_dd, $sc) or die(mysql_error());
			$row_dd = mysql_fetch_assoc($query_dd);
			$num_dd = mysql_num_rows($query_dd);
			if($num_dd == 0)
			{
				$psum = 0;
				$psum = $pay_dd + $psum;
			}else{
				$psum = $row_dd['psum'];
				$psum = $pay_dd + $psum;
			}
		
			$insert_pay_dd = "INSERT INTO pay_dd (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_dd','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_indd = mysql_query($insert_pay_dd, $sc) or die(mysql_error());
			$total = $total + $pay_dd;
		}
		//
		//產品成本最高
		if($pay_g != 0 && $gold > 0)
		{
			if($gold - $pay_g >=0)
			{
				$gold = $gold - $pay_g;
			}else{
				$pay_g = $gold;
				$gold = $gold - $gold ;
			}
			$select_g = "SELECT * FROM pay_g ORDER BY id DESC";
			$query_g = mysql_query($select_g, $sc) or die(mysql_error());
			$row_g = mysql_fetch_assoc($query_g);
			$num_g = mysql_num_rows($query_g);
			if($num_g == 0)
			{
				$psum = 0;
				$psum = $pay_g + $psum;
			}else{
				$psum = $row_g['psum'];
				$psum = $pay_g + $psum;
			}
			$insert_pay_g = "INSERT INTO pay_g (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_g','$psum','$new_number','$new_card',1,'$date','$time	','$pud_name')";
			$query_ing = mysql_query($insert_pay_g, $sc) or die(mysql_error());
			$total = $total + $pay_g;
		}
		//	
		//促銷獎勵
		if($pay_h != 0 && $gold >0)
		{
			if($gold - $pay_h >=0)
			{
				$gold = $gold - $pay_h;
			}else{
				$pay_h = $gold;
				$gold = $gold - $gold ;
			}
			$select_h = "SELECT * FROM pay_h ORDER BY id DESC";
			$query_h = mysql_query($select_h, $sc) or die(mysql_error());
			$row_h = mysql_fetch_assoc($query_h);
			$num_h = mysql_num_rows($query_h);
			if($num_h == 0)
			{
				$psum = 0;
				$psum = $pay_h + $psum;
			}else{
				$psum = $row_h['psum'];
				$psum = $pay_h + $psum;
			}
			
			$insert_pay_h = "INSERT INTO pay_h (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_h','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_inh = mysql_query($insert_pay_h, $sc) or die(mysql_error());
			$total = $total + $pay_h;
		}
		//
		//經銷商
		if($pay_f !=0 && $gold >0)
		{
			if($gold - $pay_f >=0)
			{
				$gold = $gold - $pay_f;
			}else{
				$pay_f = $gold;
				$gold = $gold - $gold ;
			}
			$select_f = "SELECT * FROM pay_f ORDER BY id DESC";
			$query_f = mysql_query($select_f, $sc) or die(mysql_error());
			$row_f = mysql_fetch_assoc($query_f);
			$num_f = mysql_num_rows($query_f);
			if($num_f == 0)
			{
				$psum = 0;
				$psum = $pay_f + $psum;
			}else{
				$psum = $row_f['psum'];
				$psum = $pay_f + $psum;
			}
			$insert_pay_f = "INSERT INTO pay_f (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_f','$psum','$new_number','$new_fard',1,'$date','$time','$pud_name')";
			$query_inf = mysql_query($insert_pay_f, $sc) or die(mysql_error());
			$total = $total + $pay_f;
		}
		//
		//車屋旅遊
		if($pay_j != 0 && $gold > 0)
		{
			if($gold - $pay_j >=0)
			{
				$gold = $gold - $pay_j;
			}else{
				$pay_j = $gold;
				$gold = $gold - $gold ;
			}
			$select_j = "SELECT * FROM pay_j ORDER BY id DESC";
			$query_j = mysql_query($select_j, $sc) or die(mysql_error());
			$row_j = mysql_fetch_assoc($query_j);
			$num_j = mysql_num_rows($query_j);
			if($num_j == 0)
			{
				$psum = 0;
				$psum = $pay_j + $psum;
			}else{
				$psum = $row_j['psum'];
				$psum = $pay_j + $psum;
			}
			$insert_pay_j = "INSERT INTO pay_j (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_j','$psum','$new_number','$new_jard',1,'$date','$time','$pud_name')";
			$query_ing = mysql_query($insert_pay_j, $sc) or die(mysql_error());
			$total = $total + $pay_j;
		}
		//
		if($pay_k !=0 && $gold >0)
		{	
			if($gold - $pay_k >=0)
			{
				$gold = $gold - $pay_k;
			}else{
				$pay_k = $gold;
				$gold = $gold - $gold ;
			}
			//內勤福利2.5%
			$select_k = "SELECT * FROM pay_k ORDER BY id DESC";
			$query_k = mysql_query($select_k, $sc) or die(mysql_error());
			$row_k = mysql_fetch_assoc($query_k);
			$num_k = mysql_num_rows($query_k);
			if($num_k == 0)
			{
				$psum = 0;
				$psum = $pay_k + $psum;
			}else{
				$psum = $row_k['psum'];
				$psum = $pay_k + $psum;
			}
			$insert_pay_k = "INSERT INTO pay_k (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_k','$psum','$new_number','$new_kard',1,'$date','$time','$pud_name')";
			$query_ink = mysql_query($insert_pay_k, $sc) or die(mysql_error());
			$total = $total + $pay_k;
		}
		//
		
			//發票與營所稅10%
		if($pay_da !=0 && $gold >0)
		{
			if($gold - $pay_da >=0)
			{
				$gold = $gold - $pay_da;
			}else{
				$pay_da = $gold;
				$gold = $gold - $gold ;
			}
			$select_da = "SELECT * FROM pay_da ORDER BY id DESC";
			$query_da = mysql_query($select_da, $sc) or die(mysql_error());
			$row_da = mysql_fetch_assoc($query_da);
			$num_da = mysql_num_rows($query_da);
			if($num_da == 0)
			{
				$psum = 0;
				$psum = $pay_da + $psum;
			}else{
				$psum = $row_da['psum'];
				$psum = $pay_da + $psum;
			}
			
			$insert_pay_da = "INSERT INTO pay_da (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_da','$psum','$new_number','$new_card',1,'$date','$time','$pud_name')";
			$query_inda = mysql_query($insert_pay_da, $sc) or die(mysql_error());
			$total = $total + $pay_da;
		}
		//
		if($pay_i != 0 && $gold > 0)
		{
			//推薦人等級
			$select_pud7 = "SELECT * FROM memberdata WHERE number = '$fnumber' ";
			$query_pud7 = mysql_query($select_pud7, $sc) or die(mysql_error());
			$row_pud7 = mysql_fetch_assoc($query_pud7);
			$pud7 = $row_pud7['a_pud'];
			$f_fuser = $row_pud7['m_fuser'];
			$sncode=$fnumber."-".date("ymdhis");
			$glevel=1;$at=0;
			if($new_pud == '2'){$pudname = "公益社群";}else if($new_pud == '3'){$pudname ="創業開店";}else if($new_pud == '4' || $new_pud == '5' || $new_pud == '6'){$pudname ="企業百勝";}else if($new_pud =='7' || $new_pud =='8' || $new_pud =='9' || $new_pud =='10'){$pudname = "總裁贏家";}
			$fnote="新註冊-(".$pudname.")分享積分<br/>帳號：".$newuser;
			
			if($fnumber != $fnumber2){
				switch ($new_pud) {
					case '2':
						$g = $pay_i-200;
						if($gold < $g){$g = $gold;$gold = 0;}
						$fusrg = $g*($businessRatio[0]*10/100);
						$fusr2g = $g*($businessRatio[1]*10/100);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$fusrg', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber2', '$year', '$moom', '$day', '$z', '$fusr2g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '3':
						$g = $pay_i-500;
						if($gold < $g){$g = $gold;$gold = 0;}
						$fusrg = $g*($businessRatio[0]*10/100);
						$fusr2g = $g*($businessRatio[1]*10/100);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$fusrg', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber2', '$year', '$moom', '$day', '$z', '$fusr2g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '4':
					case '5':
					case '6':
						$g = $pay_i-1000;
						if($gold < $g){$g = $gold;$gold = 0;}
						$fusrg = $g*($businessRatio[0]*10/100);
						$fusr2g = $g*($businessRatio[1]*10/100);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$fusrg', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber2', '$year', '$moom', '$day', '$z', '$fusr2g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '7':
					case '9':
					case '10':
						$g = $pay_i-2500;
						if($gold < $g){$g = $gold;$gold = 0;}
						$fusrg = $g*($businessRatio[0]*10/100);
						$fusr2g = $g*($businessRatio[1]*10/100);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$fusrg', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber2', '$year', '$moom', '$day', '$z', '$fusr2g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
				}
			}else{
				switch ($new_pud) {
					case '2':
						$g = $pay_i-200;
						if($gold < $g){$g = $gold;$gold = 0;}
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '3':
						$g = $pay_i-500;
						if($gold < $g){$g = $gold;$gold = 0;}
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '4':
					case '5':
					case '6':
						$g = $pay_i-1000;
						if($gold < $g){$g = $gold;$gold = 0;}
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '7':
					case '9':
					case '10':
						$g = $pay_i-2500;
						if($gold < $g){$g = $gold;$gold = 0;}
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
				}
			}
			if($gold !=0)
			{
				$aa = $row_pud7['a_pud'];
				$nn = $row_pud7['number'];
				unset($fmu,$ini_pud,$ini_nn);
				$fmu[0]=$f_fuser;
				$ini_pud[0]=$aa;
				$ini_nn[0]=$nn;
				$fmi=0;$fmi2=1;$fmk=0;
				while ($fmk != 1) {
					$ini = $fmu[$fmi];//取值往下代做收尋
					$select_ini = "SELECT * FROM memberdata WHERE number = '$ini' ";
					$query_ini = mysql_query($select_ini, $sc) or die(mysql_error());
					$row_ini = mysql_fetch_assoc($query_ini);
					$num_ini = mysql_num_rows($query_ini);
					$fmi++;
					if($num_ini != 0){
						$get = $row_ini['m_fuser'];
						if(empty($get)){$get = $row_ini['m_guser'];}
						$get_pud = $row_ini['a_pud'];
						$get_nn = $row_ini['number'];
						for($i=0;$i<$num_ini;$i++){
							$fmu[$fmi2]=$get; //把此人放入fmu[]的下個位置,fmu[0]=源頭(自己)
							$ini_pud[$fmi2]=$get_pud;
							$ini_nn[$fmi2]=$get_nn;//自己的number
							if($ini_pud[$fmi2] >= 5){
								$fnumber = $ini_nn[$fmi2];
								$select_f7 = "SELECT * FROM memberdata WHERE number = '$fnumber' ";
								$query_f7 = mysql_query($select_f7, $sc) or die(mysql_error());
								$row_f7 = mysql_fetch_assoc($query_f7);
								$finishu = $row_f7['m_username'];
								$fnote="新註冊-(".$pudname.")輔導積分<br/>帳號：".$newuser;
								$sncode=$fnumber."-".date("ymdhis");
								$glevel = 2;
								switch ($new_pud) {
									case '2':
										$g = $pay_i - 1000;
										if($gold < $g){$g = $gold;$gold = 0;}
										$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
										mysql_query($insertpud7,$sc);
										break;
									case '3':
										$g = $pay_i - 2000;
										if($gold < $g){$g = $gold;$gold = 0;}
										$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
										mysql_query($insertpud7,$sc);
										break;
									case '4':
										$g = $pay_i - 10000;
										if($gold < $g){$g = $gold;$gold = 0;}
										$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
										mysql_query($insertpud7,$sc);
										break;
									case '5':
									case '6':
										$g = $pay_i - 5000;
										if($gold < $g){$g = $gold;$gold = 0;}
										$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
										mysql_query($insertpud7,$sc);
										break;
									case '7':
										$g = $pay_i - 24000;
										if($gold < $g){$g = $gold;$gold = 0;}
										$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
										mysql_query($insertpud7,$sc);
										break;
									case '9':
									case '10':
										$g = $pay_i - 18000;
										if($gold < $g){$g = $gold;$gold = 0;}
										$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
										mysql_query($insertpud7,$sc);
										break;
								}
								$fmk=1;
							}else{
								$fmi2++;
							}
						}
					}
				}
			}
			$gold = $gold - $pay_i;
			$total = $total + $pay_i;
		}
		//
		return $total;
	}//兩代分潤20500
	

	//自購球發水庫
	function oneself_purchase($fnumber,$oneself_number,$oneself_card,$oneself_pud){
		date_default_timezone_set('Asia/Taipei');
		include('Connections/sc.php');mysql_query("set names utf8");
		
		$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
		
		mysql_select_db($database_sc, $sc);
		$select_memberdata = "SELECT * FROM memberdata WHERE number = '$oneself_number'";
		$query_memberdata = mysql_query($select_memberdata, $sc) or die(mysql_error());
		$row_memberdata = mysql_fetch_assoc($query_memberdata);
		$name = $row_memberdata['m_nick'];
		$m_username = $row_memberdata['m_username'];
		
		$select_apud = "SELECT * FROM a_pud WHERE id = $oneself_pud";
		$query_apud = mysql_query($select_apud, $sc) or die(mysql_error());
		$row_apud = mysql_fetch_assoc($query_apud);
		$num_apud = mysql_num_rows($query_apud);
		
		$fpay = $row_apud['my_fpay'];
		$pay_a = $row_apud['p'];
		$pay_b = $row_apud['b'];
		$pay_e = $row_apud['e'];
		$pay_l = $row_apud['l'];
		$pay_m = $row_apud['m'];
		//推薦人獎金
			
			$note ="福袋兌換分享積分<br>帳號:".$m_username;
			$sncode = $fnumber."-".date("ymdhis");
			$insert_gold_m = "INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '3000', '$note', '1', '0', '$date', '$time', '$sncode')";
			$query_gold_m = mysql_query($insert_gold_m,$sc);
		//
		//愛心公益
		$pud_name = "福袋兌換(".$name.")";
		$select_e = "SELECT * FROM pay_e ORDER BY id DESC";
		$query_e = mysql_query($select_e, $sc) or die(mysql_error());
		$row_e = mysql_fetch_assoc($query_e);
		$num_e = mysql_num_rows($query_e);
		if($num_e == 0)
		{
			$psum = 0;
			$psum = $pay_e + $psum;
		}else{
			$psum = $row_e['psum'];
			$psum = $pay_e + $psum;
		}
		$insert_pay_e = "INSERT INTO pay_e (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_e','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_ine = mysql_query($insert_pay_e, $sc) or die(mysql_error());
		//
		
		//組織福袋
		$select_b = "SELECT * FROM pay_b ORDER BY id DESC";
		$query_b = mysql_query($select_b, $sc) or die(mysql_error());
		$row_b = mysql_fetch_assoc($query_b);
		$num_b = mysql_num_rows($query_b);
		if($num_b == 0)
		{
			$psum = 0;
			$psum = $pay_b + $psum;
		}else{
			$psum = $row_b['psum'];
			$psum = $pay_b + $psum;
		}
		$insert_pay_b = "INSERT INTO pay_b (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_b','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_inb = mysql_query($insert_pay_b, $sc) or die(mysql_error());
		//
		//收費總庫
		$select_a = "SELECT * FROM pay_a ORDER BY id DESC";
		$query_a = mysql_query($select_a, $sc) or die(mysql_error());
		$row_a = mysql_fetch_assoc($query_a);
		$num_a = mysql_num_rows($query_a);
		if($num_a == 0)
		{
			$psum = 0;
			$psum = $pay_a + $psum;
		}else{
			$psum = $row_a['psum'];
			$psum = $pay_a + $psum;
		}
		$insert_pay_a = "INSERT INTO pay_a (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_a','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_ina = mysql_query($insert_pay_a, $sc) or die(mysql_error());
		//
		//核心運作
		$pud_name = "福袋兌換(".$name.")";
		$select_l = "SELECT * FROM pay_l ORDER BY id DESC";
		$query_l = mysql_query($select_l, $sc) or die(mysql_error());
		$row_l = mysql_fetch_assoc($query_l);
		$num_l = mysql_num_rows($query_l);
		if($num_l == 0)
		{
			$psum = 0;
			$psum = $pay_l + $psum;
		}else{
			$psum = $row_l['psum'];
			$psum = $pay_l + $psum;
		}
		$insert_pay_l = "INSERT INTO pay_l (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_l','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_inl = mysql_query($insert_pay_l, $sc) or die(mysql_error());

		//
		//公司運作
		$pud_name = "福袋兌換(".$name.")";
		$select_m = "SELECT * FROM pay_m ORDER BY id DESC";
		$query_m = mysql_query($select_m, $sc) or die(mysql_error());
		$row_m = mysql_fetch_assoc($query_m);
		$num_m = mysql_num_rows($query_m);
		if($num_m == 0)
		{
			$psum = 0;
			$psum = $pay_m + $psum;
		}else{
			$psum = $row_m['psum'];
			$psum = $pay_m + $psum;
		}
		$insert_pay_m = "INSERT INTO pay_m (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_m','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_inm = mysql_query($insert_pay_m, $sc) or die(mysql_error());

		//
		
		//
		$glevel=4;$at=0;
		$sncode=$oneself_number."-".date("ymdhis");
		$fnote="福袋關係獎勵<br/>帳號：".$m_username."";
		mysql_select_db($database_sc, $sc);
		$insertCommand15="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$fpay', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
		mysql_query($insertCommand15,$sc);
			mysql_select_db($database_sc, $sc);
		$query_Recs = sprintf("SELECT * FROM gold_sum WHERE number = '$fnumber' && year=$year && moom=$moom && day=$day");
		$Recs = mysql_query($query_Recs, $sc) or die(mysql_error());
		$row_Recs = mysql_fetch_assoc($Recs);
		$totalRows_Recs = mysql_num_rows($Recs);
		if ($totalRows_Recs == 0) {
			mysql_select_db($database_sc, $sc);
			$insertCommand15="INSERT INTO gold_sum (number, year, moom, day, z, level2) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$$fpay')"; 
			mysql_query($insertCommand15,$sc);
		} else {
			$new_level2=$row_Recs['level2']+$$fpay;
			$update11="UPDATE gold_sum SET level2= $new_level2 WHERE number = '$fnumber' && year=$year && moom=$moom && day=$day";
			mysql_select_db($database_sc, $sc);
			$Result11 = mysql_query($update11, $sc) or die(mysql_error());
		}
	}
	function ball($index){
		/**
		* 營運球和出局補球入水庫
		* index : 新補球的位置
		* obusername : 推薦人的帳號
		* obfnumber : 推薦人number
		* oneself_number : 補球的number
		* oneself_card : 補球的card
		**/
		include('Connections/sc.php');mysql_query("set names utf8");
		mysql_select_db($database_sc, $sc);
		$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
		$select_obfnumber = "SELECT fd.card,fd.number,operation_ball.fnumber,memberdata.m_username
							FROM fd 
							LEFT JOIN operation_ball ON fd.card = operation_ball.card 
							LEFT JOIN memberdata ON operation_ball.fnumber = memberdata.number
							WHERE fd.filling_position='$index'";				
		$query_obfnumber = mysql_query($select_obfnumber, $sc) or die(mysql_error());
		$row_obfnumber = mysql_fetch_assoc($query_obfnumber);

		$obusername = $row_obfnumber['m_username'];
		$obfnumber = $row_obfnumber['fnumber'];
		$oneself_number = $row_obfnumber['number'];
		$oneself_card = $row_obfnumber['card'];
		//出局球不在營運球水庫,所以抓不到funmber,m_username
		/*if(empty($obusername)){
			$select = "SELECT * FROM memberdata where number = '$oneself_number'";
			$query = mysql_query($select, $sc) or die(mysql_error());
			$result = mysql_fetch_assoc($query);
			$obfnumber = $result['m_fuser'];
			$obusername =$result['m_username'];
			//投資人的球無fuser
			if(empty($obfnumber)){
				$select = "SELECT * FROM cmg_investment where investor_id = '$oneself_number'";
				$query = mysql_query($select, $sc) or die(mysql_error());
				$result = mysql_fetch_assoc($query);
				$obfnumber = $result['refer_member_id'];
			}
			
		}*/
		/*2017.8.1 修改 by paku
		*
		*出局球不發分享積分
		*
		*/
		if(!empty($obusername))
		{
			$note ="串愛分享積分<br>帳號:".$obusername;
			$sncode = $obfnumber."-".date("ymdhis");
			$insert_gold_m = "INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$obfnumber', '$year', '$moom', '$day', '$z', '3000', '$note', '1', '0', '$date', '$time', '$sncode')";
			$query_gold_m = mysql_query($insert_gold_m,$sc);
		}else{
			$obusername ="營運球";
		}
		
		//愛心公益
		$pud_name = "補位福袋(".$obusername.")";
		$select_e = "SELECT * FROM pay_e ORDER BY id DESC";
		$query_e = mysql_query($select_e, $sc) or die(mysql_error());
		$row_e = mysql_fetch_assoc($query_e);
		$num_e = mysql_num_rows($query_e);
		$pay_e = 100;
		if($num_e == 0)
		{
			$psum = 0;
			$psum = $pay_e + $psum;
		}else{
			$psum = $row_e['psum'];
			$psum = $pay_e + $psum;
		}
		$insert_pay_e = "INSERT INTO pay_e (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_e','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_ine = mysql_query($insert_pay_e, $sc) or die(mysql_error());
		//
		
		//組織福袋
		$select_b = "SELECT * FROM pay_b ORDER BY id DESC";
		$query_b = mysql_query($select_b, $sc) or die(mysql_error());
		$row_b = mysql_fetch_assoc($query_b);
		$num_b = mysql_num_rows($query_b);
		$pay_b = 20000;
		if($num_b == 0)
		{
			$psum = 0;
			$psum = $pay_b + $psum;
		}else{
			$psum = $row_b['psum'];
			$psum = $pay_b + $psum;
		}
		$insert_pay_b = "INSERT INTO pay_b (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_b','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_inb = mysql_query($insert_pay_b, $sc) or die(mysql_error());
		//
		//核心運作
		$select_l = "SELECT * FROM pay_l ORDER BY id DESC";
		$query_l = mysql_query($select_l, $sc) or die(mysql_error());
		$row_l = mysql_fetch_assoc($query_l);
		$num_l = mysql_num_rows($query_l);
		$pay_l = 2000;
		if($num_l == 0)
		{
			$psum = 0;
			$psum = $pay_l + $psum;
		}else{
			$psum = $row_l['psum'];
			$psum = $pay_l + $psum;
		}
		$insert_pay_l = "INSERT INTO pay_l (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_l','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_inl = mysql_query($insert_pay_l, $sc) or die(mysql_error());

		//
		//公司運作

		$select_m = "SELECT * FROM pay_m ORDER BY id DESC";
		$query_m = mysql_query($select_m, $sc) or die(mysql_error());
		$row_m = mysql_fetch_assoc($query_m);
		$num_m = mysql_num_rows($query_m);
		$pay_m = 4900;
		if($num_m == 0)
		{
			$psum = 0;
			$psum = $pay_m + $psum;
		}else{
			$psum = $row_m['psum'];
			$psum = $pay_m + $psum;
		}
		$insert_pay_m = "INSERT INTO pay_m (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_m','$psum','$oneself_number','$oneself_card',1,'$date','$time','$pud_name')";
		$query_inm = mysql_query($insert_pay_m, $sc) or die(mysql_error());
		//
	}
}
?>