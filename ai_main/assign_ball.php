<?php
/**
*每日轉換資金至營運球庫
*/
require_once('Connections/sc.php');mysql_query("set names utf8");

	mysql_select_db($database_sc, $sc);
	$select_investment ="SELECT * FROM cmg_investment ";
	$query_investment = mysql_query($select_investment, $sc) or die(mysql_error());
	$row_investment = mysql_fetch_assoc($query_investment);
	$num_invertment = mysql_num_rows($query_investment);
	$date = date("Y-m-d");
	$time = date("H:i:s");
	$investor_arr = array();
	$index = 0;
	for($i=0;$i<$num_invertment;$i++)
	{
		$fnumber = $row_investment["refer_member_id"];
		$number  = $row_investment["investor_id"];
		$id = $row_investment["serial_no"];
		
		$operation_amount = $row_investment["op_balance"]; 
		$rest = $operation_amount-300000;
		
		
		if($rest >= 0)
		{
			if(!in_array($number,$investor_arr))
			{
				$investor_arr[$index] = $number;
				print_r($investor_arr[$index]);
				$index++;
				
				for($j=1 ;$j<=10;$j++)
				{
					$bo="boss";
					
					$query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");

					$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());

					$row_Reci = mysql_fetch_assoc($Reci);

					$num_box=$row_Reci['fd_box'];
					$num_z = $row_Reci['fd_m'];

					if(date("m") != $num_z) {
						echo $num_z;
						$numz=date("m");

						$update11="UPDATE admin SET fd_m=$numz WHERE username='$bo'";

						$Result11 = mysql_query($update11, $sc) or die(mysql_error());

						$num_box=1;

					}
					date_default_timezone_set('Asia/Taipei');
					
					if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}

					if ($num_box < 10) {$fdcard="f".date("ym")."000".$num_box;}

					if ($num_box > 9 && $num_box < 100) {$fdcard="f".date("ym")."00".$num_box;}

					if ($num_box < 1000 && $num_box > 99) {$fdcard="f".date("ym")."0".$num_box;}

					if ($num_box < 10000 && $num_box > 999) {$fdcard="f".date("ym").$num_box;}
					
					$insert_operation ="INSERT INTO operation_ball (fnumber,number,card,use_status,create_date,investor_no) VALUES ('$fnumber','$number','$fdcard','0','$date','$id')";
					$query_insert = mysql_query($insert_operation, $sc) or die(mysql_error());
				
				
					$new_num_box=$num_box+1;
					$update11="UPDATE admin SET fd_box=$new_num_box WHERE username='$bo'";
					$Result11 = mysql_query($update11, $sc) or die(mysql_error());
				}
				
				$update11="UPDATE cmg_investment SET op_balance=$rest,last_op_date='$date' WHERE serial_no='$id'";
				$Result11 = mysql_query($update11, $sc) or die(mysql_error());

			}
		}
		$row_investment = mysql_fetch_assoc($query_investment);
	}
	
?>