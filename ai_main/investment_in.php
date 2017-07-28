<?php
require_once('Connections/sc.php');mysql_query("set names utf8");
//submit_after
$user_name = $_POST["user_name"];
$operation_amount = $_POST["operation_amount"];
date_default_timezone_set('Asia/Taipei');
$date = date("Y-m-d");
$time = date("H:i:s");

$ball_unit = 30000;
$fuser =$_POST["fuser"];

		
if($user_name !="")
{
	
	$num = $operation_amount / $ball_unit;
	$select_user="SELECT * FROM memberdata WHERE m_nick='$user_name'";
	
	$query_user = mysql_query($select_user, $sc) or die(mysql_error());

	$row_user = mysql_fetch_assoc($query_user);
	
	$num_user = mysql_num_rows($query_user);
	
	$select_fmember = "SELECT * FROM memberdata WHERE m_username='$fuser'";
	$query_fmember = mysql_query($select_fmember, $sc) or die(mysql_error());
	$row_fmember = mysql_fetch_assoc($query_fmember);
	$fnumber = $row_fmember["number"];
	
	
	//投資者資料
	if($num_user >0)
	{
		//memberdata資料已存在
		$number = $row_user["number"];
		
		$insert_operation ="INSERT INTO cmg_investment (investor_id,investor_name,refer_member_id,invest_amount,op_balance,created_date,status) VALUES ('$number','$user_name','$fnumber','$operation_amount','$operation_amount','$date','A')";
		$query_insert = mysql_query($insert_operation, $sc) or die(mysql_error());
		
		
	}else{
		//非會員,第一次投資
		mysql_select_db($database_sc, $sc);$bo="boss";

		$query_Reci = sprintf("SELECT * FROM admin WHERE username='$bo'");

		$Reci = mysql_query($query_Reci, $sc) or die(mysql_error());

		$row_Reci = mysql_fetch_assoc($Reci);

		$num_box=$row_Reci['fd_box'];
		$num_n =$row_Reci["num_box"];

		$num_z=$row_Reci['fd_m'];

		if(date("m") != $num_z) {

		   $numz=date("m");

		   $update11="UPDATE admin SET fd_m=$numz WHERE username='$bo'";

		   mysql_select_db($database_sc, $sc);

		   $Result11 = mysql_query($update11, $sc) or die(mysql_error());

		   $num_box=1;

		   }
		
		if ($num_box == 10000) {echo "設定值巳超過9999單號，請洽系統工程師。";exit;}

		if ($num_box < 10) {$number="SN".date("ymd")."000".$num_n;$fdcard="f".date("ym")."000".$num_box;}

		if ($num_box > 9 && $num_box < 100) {$number="SN".date("ymd")."00".$num_n;$fdcard="f".date("ym")."00".$num_box;}

		if ($num_box < 1000 && $num_box > 99) {$number="SN".date("ymd")."0".$num_n;$fdcard="f".date("ym")."0".$num_box;}

		if ($num_box < 10000 && $num_box > 999) {$number="SN".date("ymd").$num_n;$fdcard="f".date("ym").$num_box;}
		
		$insert_memberdata ="INSERT INTO memberdata (m_nick,m_username, m_passwd, m_passtoo, number) VALUES ('$user_name','$number', '123456', '123456', '$number')"; 
		$query_insert = mysql_query($insert_memberdata, $sc) or die(mysql_error());
	
		$new_num_box=$num_n+1;
		$update11="UPDATE admin SET num_box=$new_num_box WHERE username='$bo'";

		mysql_select_db($database_sc, $sc);

		$Result11 = mysql_query($update11, $sc) or die(mysql_error());
		
		$insert_operation ="INSERT INTO cmg_investment (investor_id,investor_name,refer_member_id,invest_amount,op_balance,created_date,status) VALUES ('$number','$user_name','$fnumber','$operation_amount','$operation_amount','$date','A')";
		$query_insert = mysql_query($insert_operation, $sc) or die(mysql_error());
	}
	
}	 
 echo "<script> window.location.href = '/ai_main/pay_o.php';</script>"
?>