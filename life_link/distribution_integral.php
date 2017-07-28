<?php 
require_once('Connections/sc.php');mysql_query("set names utf8");
date_default_timezone_set('Asia/Taipei');
mysql_select_db($database_sc, $sc);
header("Content-Type:text/html; charset=utf-8");

$select_fd ="SELECT * FROM gold_m WHERE at = 0 ORDER BY id DESC";
$query_fd = mysql_query($select_fd, $sc) or die(mysql_error());
$row_fd = mysql_fetch_assoc($query_fd);
$num_fd = mysql_num_rows($query_fd);

$today = date("Y-m-d");
$time = date("H:i:m");



//echo date("Y-m-d",strtotime("$date +1 day"));
#print_r($row_fd);


	for($i=0; $i<$num_fd; $i++){
		
		$date = $row_fd['date'];
		$dd = date("Y-m-d",strtotime("$date +8 day"));
		//超過7天可以轉換
		if($today >= $dd){
			
			$g = $row_fd['g'];
			$number = $row_fd['number'];
			$gold_id = $row_fd['id'];
			$note = $row_fd['note'];
			//回扣單
			if($g<0){
				$cash = $g;
				$update="UPDATE gold_m SET at=1 WHERE id = '$gold_id'";
				$query_update = mysql_query($update, $sc) or die(mysql_error());
				
				$select_c ="SELECT c_cash.id,memberdata.m_username,c_cash.csum FROM memberdata,c_cash WHERE memberdata.number = '$number' and c_cash.number ='$number' ORDER BY id DESC";
				$query_c = mysql_query($select_c, $sc) or die(mysql_error());
				$row_c = mysql_fetch_assoc($query_c);
				$num_c = mysql_num_rows($query_c);
				
				$csum = $row_c['csum'];
				$user =  $row_c['m_username'];
				
				$csum = $csum + $cash;
				
			
				$insert_c = "INSERT INTO c_cash (number,cin,csum,note,date,time,gold_id)VALUES('$number','$cash','$csum','$note','$today','$time','$gold_id')";
				$query_insert_c = mysql_query($insert_c, $sc) or die(mysql_error());
			//獎金
			}else{
				if($g == 40000 )
				{
					$cash = 30000;
					$gash = 10000;
				}else{
					$cash = $g*80/100;
					$gash = $g*20/100;
				}
				
				$update="UPDATE gold_m SET at=1 WHERE id = '$gold_id'";
				$query_update = mysql_query($update, $sc) or die(mysql_error());
				
				$select = "SELECT SUM(arrears) as Balance ,Tnumber FROM `pay_ar` WHERE number='$number'";
				$query = mysql_query($select, $sc) or die(mysql_error());
				$row = mysql_fetch_assoc($query);
				$Tnumber = $row['Tnumber'];
				$Balance = $row['Balance'];
				
				if($Balance < 0){
					
					if(abs($Balance) >= $g){
						$insert = "INSERT INTO pay_ar (number,arrears,Tnumber,date,status)VALUES('$number','$g','$Tnumber','$date','$gold_id')";
						$query = mysql_query($insert, $sc) or die(mysql_error());
					}else{
						$Repayment = abs($Balance);
						$Balance = $g - $Repayment;
						$cash = $Balance*80/100;
						$gash = $Balance*20/100;
						$insert = "INSERT INTO pay_ar (number,arrears,Tnumber,date,status)VALUES('$number','$Repayment','$Tnumber','$date','$gold_id')";
						$query = mysql_query($insert, $sc) or die(mysql_error());
						
						$select_c ="SELECT c_cash.id,memberdata.m_username,c_cash.csum FROM memberdata,c_cash WHERE memberdata.number = '$number' and c_cash.number ='$number' ORDER BY id DESC";
						$query_c = mysql_query($select_c, $sc) or die(mysql_error());
						$row_c = mysql_fetch_assoc($query_c);
						$num_c = mysql_num_rows($query_c);
						$csum = $row_c['csum'];
						$user =  $row_c['m_username'];
						$csum = $csum + $cash;
						
						$insert_c = "INSERT INTO c_cash (number,cin,csum,note,date,time,gold_id)VALUES('$number','$cash','$csum','$note','$today','$time','$gold_id')";
						$query_insert_c = mysql_query($insert_c, $sc) or die(mysql_error());
						
						$select_g ="SELECT g_cash.id,memberdata.m_username,g_cash.csum FROM memberdata,g_cash WHERE memberdata.number = '$number' and g_cash.number ='$number' ORDER BY id DESC";
						$query_g = mysql_query($select_g, $sc) or die(mysql_error());
						$row_g = mysql_fetch_assoc($query_g);
						$num_g = mysql_num_rows($query_g);
						$gsum = $row_g['csum'];
						$user =  $row_c['m_username'];
						$gsum = $gsum + $gash;
						
						$insert_g = "INSERT INTO g_cash (number,cin,csum,note,date,time,gold_id)VALUES('$number','$gash','$gsum','$note','$today','$time','$gold_id')";
						$query_insert_g = mysql_query($insert_g, $sc) or die(mysql_error());
					}
				}else{
					
					
					$select_c ="SELECT c_cash.id,memberdata.m_username,c_cash.csum FROM memberdata,c_cash WHERE memberdata.number = '$number' and c_cash.number ='$number' ORDER BY id DESC";
					$query_c = mysql_query($select_c, $sc) or die(mysql_error());
					$row_c = mysql_fetch_assoc($query_c);
					$num_c = mysql_num_rows($query_c);
					$csum = $row_c['csum'];
					$user =  $row_c['m_username'];
					$csum = $csum + $cash;
					

					$insert_c = "INSERT INTO c_cash (number,cin,csum,note,date,time,gold_id)VALUES('$number','$cash','$csum','$note','$today','$time','$gold_id')";
					$query_insert_c = mysql_query($insert_c, $sc) or die(mysql_error());
					
					$select_g ="SELECT g_cash.id,memberdata.m_username,g_cash.csum FROM memberdata,g_cash WHERE memberdata.number = '$number' and g_cash.number ='$number' ORDER BY id DESC";
					$query_g = mysql_query($select_g, $sc) or die(mysql_error());
					$row_g = mysql_fetch_assoc($query_g);
					$num_g = mysql_num_rows($query_g);
					$gsum = $row_g['csum'];
					$user =  $row_c['m_username'];
					$gsum = $gsum + $gash;
					
			
					$insert_g = "INSERT INTO g_cash (number,cin,csum,note,date,time,gold_id)VALUES('$number','$gash','$gsum','$note','$today','$time','$gold_id')";
					$query_insert_g = mysql_query($insert_g, $sc) or die(mysql_error());
				}
			}

			
			
		}
		$row_fd = mysql_fetch_assoc($query_fd);

	}

?>