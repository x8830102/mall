<?php
require_once('Connections/sc.php');mysql_query("set names utf8");
mysql_select_db($database_sc, $sc);
/*
*每日檢查還款狀況
*如果總和已達到0,即可將

*
*/
$year=date("Y");$moom=date("m");$day=date("d");$z=date("z");$date=date("Y-m-d");$time=date("H:i:s");$nyear = $year +1;
	$query = $pdo_cmg->query("SELECT `pay_ar`.*,sum(`pay_ar`.`arrears`)as blance,`memberdata`.`m_username`,`memberdata`.`a_pud`,`memberdata`.`m_fuser`,`a_pud`.*
							FROM `pay_ar` 
                            INNER JOIN `memberdata` ON `pay_ar`.`number` = `memberdata`.`number`
                            INNER JOIN `a_pud` ON `memberdata`.`a_pud` = `a_pud`.`id`
                            WHERE `memberdata`.`a_pud` != 8
                            GROUP BY `pay_ar`.`number`");
	$result = $query->fetchAll();
	$count = $query->rowCount();
	foreach($result as $result)
	{
		/**還款補發水庫程式
		* number	還款人編號
		* fnumber	還款人推薦人
		* arrears	欠款數目
		* a_pud		還款人等級
		* status	還款狀態 0已還 | 1未還
		**/
		$blance = $result['blance'];
		if($blance >=0)
		{
			$number = $result['number'];
			$fuser = $result['m_fuser'];
			$user = $result['m_username'];
			$arrears = abs($result['arrears']);
			$Tnumber = $result['Tnumber'];
			$a_pud = $result['a_pud'];
			$status = $result['status'];
			$name = $result['name'];
			$pay_da = $result['d_a'];
			$pay_db = $result['d_b'];
			$pay_dc = $result['d_c'];
			$pay_dd = $result['d_d'];
			$pay_e = $result['e'];
			$pay_i = $result['i'];
			$pay_n = $result['n'];
			$pay_b = $result['b'];
			$pay_g = $result['g'];
			$pay_h = $result['h'];
			$pay_c = $result['c'];
			$pay_j = $result['j'];
			$pay_k = $result['k'];
			$pay_d = $result['d'];
			$pay_f = $result['f'];
			$pay_o = $result['o'];
			$pay_q = $result['q'];
			$pud_name = $name."(福音專案):".$user;
			//echo $arrears."-".$a_pud."-".$pay_i."-".$number."-".$fuser."-";
			$Check=0;
			$CheckArrears = $arrears;
			/**
			* 分享積分
			**/
			if($pay_i !=0 && $arrears >0){
				if($a_pud =='7' || $a_pud =='8'|| $a_pud =='9'|| $a_pud =='10'){
					$pudname = "總裁贏家";
				}
				$fnote="(".$pudname.")分享積分<br/>帳號：".$user;
				$glevel=1;$at=0;
				$sncode=$fuser."-".date("ymdhis");
				
				switch ($a_pud) {
					case '2':
						$pudname = "公益社群";
						$g = $pay_i-200;
						$arrears =$arrears - $g;
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fuser', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '5':
					case '6':
						$pudname ="企業贏家";
						$g = $pay_i-1000;
						$arrears =$arrears - $g;
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fuser', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
					case '9':
					case '10':
						$g = $pay_i-2500;
						$arrears =$arrears - $g;
						$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fuser', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
						mysql_query($insertpud7,$sc);
						break;
				}
				if($arrears >0)
				{	
					unset($fmu,$ini_pud,$ini_nn);
					$fmi=0;$fmi2=1;$fmk=0;
					while ($fmk != 1) {
						$ini = $fuser;//取值往下代做收尋
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
									$fnumber = $fmu[$fmi2];
									$select_f7 = "SELECT * FROM memberdata WHERE number = '$fnumber' ";
									$query_f7 = mysql_query($select_f7, $sc) or die(mysql_error());
									$row_f7 = mysql_fetch_assoc($query_f7);
									$finishu = $row_f7['m_username'];
									$fnote="(".$pudname.")---輔導積分<br/>帳號：".$user;
									$sncode=$fnumber."-".date("ymdhis");
									$glevel = 2;
									switch ($a_pud) {
										case '2':
											$g = $pay_i - 1000;
											$arrears =$arrears - $g;
											$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
											mysql_query($insertpud7,$sc);
											break;
										case '5':
										case '6':
											$g = $pay_i - 5000;
											$arrears =$arrears - $g;
											$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$fnumber', '$year', '$moom', '$day', '$z', '$g', '$fnote', '$glevel', '$at', '$date', '$time', '$sncode')"; 
											mysql_query($insertpud7,$sc);
											break;
										case '9':
										case '10':
											$g = $pay_i - 18000;
											$arrears =$arrears - $g;
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
				}$Check = $Check + $pay_i;
			}//
			/**
			* 發票與營所稅10%
			**/
			if($pay_da !=0 && $arrears >0){
				if($arrears - $pay_da >=0)
				{
					$arrears = $arrears - $pay_da;
				}else{
					$pay_da = $arrears;
					$arrears = $arrears - $arrears ;
				}
				$select_da = "SELECT * FROM pay_da ORDER BY id DESC";
				$query_da = mysql_query($select_da, $sc) or die(mysql_error());
				$row_da = mysql_fetch_assoc($query_da);
				$num_da = mysql_num_rows($query_da);
				if($num_da == 0)
				{
					$psum = 0;
					$psum = $pay_da + $psum;
				} else {
					$psum = $row_da['psum'];
					$psum = $pay_da + $psum;
				}
				$insert_pay_da = "INSERT INTO pay_da (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_da','$psum','$number','$card',1,'$date','$time','$pud_name')";
				$query_inda = mysql_query($insert_pay_da, $sc) or die(mysql_error());
				$Check = $Check + $pay_da;
			}//
			/**
			* 內勤福利2.5%
			**/
			if($pay_k !=0 && $arrears >0)
			{	
				if($arrears - $pay_k >=0)
				{
					$arrears = $arrears - $pay_k;
				}else{
					$pay_k = $arrears;
					$arrears = $arrears - $arrears ;
				}
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
				$insert_pay_k = "INSERT INTO pay_k (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_k','$psum','$number','$new_kard',1,'$date','$time','$pud_name')";
				$query_ink = mysql_query($insert_pay_k, $sc) or die(mysql_error());
				$Check = $Check + $pay_k;
			}//
			//車屋旅遊
			if($pay_j != 0 && $arrears > 0)
			{
				if($arrears - $pay_j >=0)
				{
					$arrears = $arrears - $pay_j;
				}else{
					$pay_j = $arrears;
					$arrears = $arrears - $arrears ;
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
				$insert_pay_j = "INSERT INTO pay_j (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_j','$psum','$number','$new_jard',1,'$date','$time','$pud_name')";
				$query_ing = mysql_query($insert_pay_j, $sc) or die(mysql_error());
				$Check = $Check + $pay_j;
			}
			//
			//經銷商
			if($pay_f !=0 && $arrears >0)
			{
				if($arrears - $pay_f >=0)
				{
					$arrears = $arrears - $pay_f;
				}else{
					$pay_f = $arrears;
					$arrears = $arrears - $arrears ;
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
				$insert_pay_f = "INSERT INTO pay_f (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_f','$psum','$number','$new_fard',1,'$date','$time','$pud_name')";
				$query_inf = mysql_query($insert_pay_f, $sc) or die(mysql_error());
				$Check = $Check + $pay_f;
			}
			//
			//促銷獎勵
			if($pay_h != 0 && $arrears >0)
			{
				if($arrears - $pay_h >=0)
				{
					$arrears = $arrears - $pay_h;
				}else{
					$pay_h = $arrears;
					$arrears = $arrears - $arrears ;
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
				
				$insert_pay_h = "INSERT INTO pay_h (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_h','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_inh = mysql_query($insert_pay_h, $sc) or die(mysql_error());
				$Check = $Check + $pay_h;
			}
			//
			//產品成本最高
			if($pay_g != 0 && $arrears > 0)
			{
				if($arrears - $pay_g >=0)
				{
					$arrears = $arrears - $pay_g;
				}else{
					$pay_g = $arrears;
					$arrears = $arrears - $arrears ;
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
				$insert_pay_g = "INSERT INTO pay_g (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_g','$psum','$number','$new_card',1,'$date','$time	','$pud_name')";
				$query_ing = mysql_query($insert_pay_g, $sc) or die(mysql_error());
				$Check = $Check + $pay_g;
			}
			//
			//人事管銷雜項
			if($pay_dd != 0 && $arrears > 0)
			{
				if($arrears - $pay_dd >=0)
				{
					$arrears = $arrears - $pay_dd;
				}else{
					$pay_dd = $arrears;
					$arrears = $arrears - $arrears ;
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
			
				$insert_pay_dd = "INSERT INTO pay_dd (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_dd','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_indd = mysql_query($insert_pay_dd, $sc) or die(mysql_error());
				$Check = $Check + $pay_dd;
			}
			//
			//系統開發建置費20%
			if($pay_dc !=0 && $arrears > 0)
			{
				if($arrears - $pay_dc >=0)
				{
					$arrears = $arrears - $pay_dc;
				}else{
					$pay_dc = $arrears;
					$arrears = $arrears - $arrears ;
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
				
				$insert_pay_dc = "INSERT INTO pay_dc (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_dc','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_indc = mysql_query($insert_pay_dc, $sc) or die(mysql_error());
				$Check = $Check + $pay_dc;
			}
			//
			//銀行紅陽刷卡2.8%
			if($pay_db != 0 && $arrears > 0)
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
				
				$insert_pay_db = "INSERT INTO pay_db (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_db','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_indb = mysql_query($insert_pay_db, $sc) or die(mysql_error());
				$arrears = $arrears - $pay_db;
				$Check = $Check + $pay_db;
			}
			//
			//場地
			if($pay_o != 0 && $arrears >0)
			{
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
			
				$insert_pay_o = "INSERT INTO pay_o (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_o','$psum','$number','$new_fard',1,'$date','$time','$pud_name')";
				$query_ino = mysql_query($insert_pay_o, $sc) or die(mysql_error());
				$arrears = $arrears - $pay_o;
				$Check = $Check + $pay_o;
			}
			//
			//靜態2.5%特別分紅3000
			if($pay_c != 0 && $arrears > 0 )
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
				$insert_pay_c = "INSERT INTO pay_c (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_c','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_inc = mysql_query($insert_pay_c, $sc) or die(mysql_error());
				$arrears = $arrears - $pay_c;
				$Check = $Check + $pay_c;

			}//
			//講師2500
			if($pay_q != 0 && $arrears > 0)
			{
				$note = "教育積分<br>帳號:".$newuser;
				$sncode=$Tnumber."-".date("ymdhis");
				$glevel = 3;
				$insertpud7="INSERT INTO gold_m (number, year, moom, day, z, g, note, level, at, date, time, sncode) VALUES ('$Tnumber', '$year', '$moom', '$day', '$z', '$pay_q', '$note', '$glevel', '0', '$date', '$time', '$sncode')"; 
				mysql_query($insertpud7,$sc);
				$arrears = $arrears - $pay_q;
				$Check = $Check + $pay_q;
			}
			////組織運作1000
			if($pay_d !=0 && $arrears > 0)
			{
				if($arrears - $pay_d >=0)
				{
					$arrears = $arrears - $pay_d;
				}else{
					$pay_d = $arrears;
					$arrears = $arrears - $arrears ;
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
				$insert_pay_d = "INSERT INTO pay_d (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_d','$psum','$number','$new_dard',1,'$date','$time','$pud_name')";
				$query_ind = mysql_query($insert_pay_d, $sc) or die(mysql_error());	
				$Check = $Check + $pay_d;
			}
			//
			//愛心公益100
			if($pay_e !=0 && $arrears > 0)
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
				
				$insert_pay_e = "INSERT INTO pay_e (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_e','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_ine = mysql_query($insert_pay_e, $sc) or die(mysql_error());
				$arrears = $arrears - $pay_e;
				$Check = $Check + $pay_e;
			}
			//
			//組織福袋20000
			if($pay_b !=0 && $arrears > 0)
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
				
				$insert_pay_b = "INSERT INTO pay_b (pin,psum,number,card,at,date,time,pud_name) VALUES ('$pay_b','$psum','$number','$new_card',1,'$date','$time','$pud_name')";
				$query_inb = mysql_query($insert_pay_b, $sc) or die(mysql_error());
				$arrears = $arrears - $pay_b;
				$Check = $Check + $pay_b;
			}
			//
			if($Check == $CheckArrears){
				//echo "總共入水庫:".$Check.'<br>';
				$query = $pdo_cmg->prepare("UPDATE `pay_ar` SET `status` = '1' WHERE `number` = '$number'");
				$query->execute();
			}
		}
	}
	