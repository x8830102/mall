<?php 
require_once('Connections/sc.php');mysql_query("set names utf8");
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	$a = $_POST["a"]; //fuser
	$b = $_POST["b"]; //user_name
	$c = $_POST["c"]; //operation_amount

	mysql_select_db($database_sc, $sc);
	$select_member = "SELECT * FROM memberdata WHERE m_username='$a'";
	$query_member = mysql_query($select_member, $sc) or die(mysql_error());
	$num_member = mysql_num_rows($query_member);
	
	$arr = array("a"=>$a,"b"=>$b,"c"=>$c,"d"=>$num_member);
	$arr = json_encode($arr);
	echo $arr;
}
?>